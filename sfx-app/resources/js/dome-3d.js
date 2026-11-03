/* ======================== */
window.SFX = window.SFX || {};

SFX.dome3d = (function () {
  'use strict';
  var THREE = window.THREE, K = SFX.kit;
  var A = 78, B = 54, H = 32, NC = 24;           // semi-axes, crown height, meridian cables
  var NT = 120, NR = 30;                          // membrane segments around / up
  var renderer, scene, camera, stage, canvas, membrane, cableLines, uv, st;
  var running = false, raf = 0, visible = false, routeActive = true, started = false, clock = 0, lastT = 0, mobile = false;
  var state = { p: 0, lay: 0, inflate: 0, photo: 0 };
  var ui = {};

  function clamp01(x) { return x < 0 ? 0 : x > 1 ? 1 : x; }
  function ease(x) { return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2; }
  function lerp(a, b, t) { return a + (b - a) * t; }

  // Membrane position for angle th (0..2pi) and radial parameter r (1 = base ring, 0 = crown)
  var tmp = new THREE.Vector3();
  function memPos(th, r, inf, t, out) {
    var c = Math.cos(th), s = Math.sin(th);
    var frac = (th / (Math.PI * 2) * NC) % 1, pillow = Math.sin(frac * Math.PI);   // lobes between cables
    var shell = Math.pow(Math.max(0, 1 - r * r), 0.62);
    var h = H * inf;
    var bulge = pillow * 1.1 * inf * Math.sqrt(shell + 0.02);
    var slack = (1 - inf);
    var wr = slack * slack * (0.9 * Math.sin(th * 23 + r * 17 + t * 0.6) + 0.5 * Math.sin(th * 41 - r * 29)) * (1 - r * 0.3);
    var rr = r + bulge * 0.012 * r;
    out.x = A * rr * c; out.z = B * rr * s;
    out.y = 1.6 + h * shell + bulge * shell * 0.6 + Math.max(0, wr) * 0.9 + slack * 0.15;
    return out;
  }

  function buildScene() {
    var sky = K.sky(900); sky.material.uniforms.uSun.value.set(-210, 120, 150).normalize(); scene.add(sky);
    var sl = K.skyline(700, mobile); sl.material.color.set('#8c98a8'); scene.add(sl);
    scene.add(K.ground(1600, '#b8a582'));
    var lawn = new THREE.Mesh(new THREE.CircleGeometry(1, 64), new THREE.MeshStandardMaterial({ color: '#3f6a2c', roughness: 1 }));
    lawn.scale.set(A + 26, B + 26, 1); lawn.rotation.x = -Math.PI / 2; lawn.position.y = 0.01; lawn.receiveShadow = true; scene.add(lawn);
    var path = new THREE.Mesh(new THREE.CircleGeometry(1, 64), new THREE.MeshStandardMaterial({ color: '#d2c8b6', roughness: 1 }));
    path.scale.set(A + 8, B + 8, 1); path.rotation.x = -Math.PI / 2; path.position.y = 0.015; path.receiveShadow = true; scene.add(path);
    var pitch = K.pitch(renderer); pitch.position.y = 0.03; scene.add(pitch);
    var gg = new THREE.Group(); gg.position.y = 0.03; K.goals(gg, 52.5); scene.add(gg);

    // Ring beam (concrete) that the membrane is clamped to
    var ring = []; for (var i = 0; i <= 128; i++) { var a = i / 128 * Math.PI * 2; ring.push(new THREE.Vector3(A * Math.cos(a), 0.8, B * Math.sin(a))); }
    var rb = new THREE.Mesh(new THREE.TubeGeometry(new THREE.CatmullRomCurve3(ring, true), 256, 0.9, 8, true), new THREE.MeshStandardMaterial({ color: '#cfcac0', roughness: 0.9 }));
    rb.castShadow = true; rb.receiveShadow = true; scene.add(rb);

    // Entrance airlock + canopy facing the camera side (+z), air-handling units on the flank
    var white = new THREE.MeshStandardMaterial({ color: '#f2f1ee', roughness: 0.5 }), glass = new THREE.MeshStandardMaterial({ color: '#2c4157', roughness: 0.15, metalness: 0.3 });
    var lock = new THREE.Mesh(new THREE.BoxGeometry(14, 5.5, 9), white); lock.position.set(22, 2.75, B + 3); lock.castShadow = true; lock.receiveShadow = true; scene.add(lock);
    var door = new THREE.Mesh(new THREE.BoxGeometry(9, 3.6, 0.2), glass); door.position.set(22, 1.9, B + 7.6); scene.add(door);
    var canopy = new THREE.Mesh(new THREE.BoxGeometry(18, 0.5, 5), white); canopy.position.set(22, 5.6, B + 9); canopy.castShadow = true; scene.add(canopy);
    var unitMat = new THREE.MeshStandardMaterial({ color: '#b9bec5', metalness: 0.4, roughness: 0.5 });
    for (var u = 0; u < 3; u++) { var ang = 0.12 + u * 0.09; var unit = new THREE.Mesh(new THREE.BoxGeometry(5, 3.2, 3), unitMat); unit.position.set((A + 6) * Math.cos(ang), 1.6, (B + 6) * Math.sin(ang)); unit.rotation.y = -ang; unit.castShadow = true; scene.add(unit); }
    var r = K.rng(21);
    for (var k = 0; k < 14; k++) { var p = K.person(['#33475f', '#7a4b3a', '#d8d2c4', '#26507a', '#a33b2f'][k % 5]); p.position.set(8 + r() * 30, 0, B + 11 + r() * 12); p.rotation.y = r() * 6; scene.add(p); }
    for (var q = 0; q < 18; q++) { var an = Math.PI * 0.15 + q / 18 * Math.PI * 0.75, palm = K.palm(8 + r() * 4); palm.position.set((A + 22 + r() * 6) * Math.cos(an), 0, (B + 22 + r() * 6) * Math.sin(an)); scene.add(palm); }

    // Membrane
    var geo = new THREE.PlaneGeometry(1, 1, NT, NR);
    uv = new Float32Array(geo.attributes.position.count * 2);
    for (var n = 0, iy = 0; iy <= NR; iy++) for (var ix = 0; ix <= NT; ix++, n++) { uv[n * 2] = ix / NT * Math.PI * 2; uv[n * 2 + 1] = 1 - iy / NR; }
    membrane = new THREE.Mesh(geo, new THREE.MeshStandardMaterial({ color: '#f6f5f1', roughness: 0.5, metalness: 0, side: THREE.DoubleSide, transparent: true, opacity: 0 }));
    membrane.castShadow = true; membrane.receiveShadow = true; membrane.frustumCulled = false; scene.add(membrane);
    // Meridian restraint cables
    var cg = new THREE.BufferGeometry(); cg.setAttribute('position', new THREE.BufferAttribute(new Float32Array(NC * NR * 2 * 3), 3));
    cableLines = new THREE.LineSegments(cg, new THREE.LineBasicMaterial({ color: '#7d858f', transparent: true, opacity: 0 })); cableLines.frustumCulled = false; scene.add(cableLines);

    var hemi = new THREE.HemisphereLight('#bcd2ec', '#8a7a5e', 0.38); scene.add(hemi);
    var sun = new THREE.DirectionalLight('#ffe2bc', 1.9); sun.position.set(-210, 120, 150); sun.castShadow = true;
    var s = mobile ? 1024 : 2048; sun.shadow.mapSize.set(s, s);
    var sc = sun.shadow.camera; sc.left = -130; sc.right = 130; sc.top = 130; sc.bottom = -130; sc.near = 50; sc.far = 600;
    sun.shadow.bias = -0.0004; sun.shadow.normalBias = 0.8; scene.add(sun);
  }

  var lastKey = '';
  function updateMembrane(t) {
    var inf = ease(state.inflate), key = inf.toFixed(4) + '|' + state.lay.toFixed(3);
    var anim = inf < 0.999 && state.lay > 0.001;
    if (!anim && key === lastKey) return; lastKey = key;
    membrane.material.opacity = state.lay; membrane.visible = state.lay > 0.001;
    var pos = membrane.geometry.attributes.position;
    for (var n = 0; n < pos.count; n++) { memPos(uv[n * 2], uv[n * 2 + 1], inf, t, tmp); pos.setXYZ(n, tmp.x, tmp.y, tmp.z); }
    pos.needsUpdate = true; membrane.geometry.computeVertexNormals();
    var cp = cableLines.geometry.attributes.position, m = 0;
    for (var c = 0; c < NC; c++) {
      var th = c / NC * Math.PI * 2 + 1e-4;
      for (var j = 0; j < NR; j++) {
        memPos(th, 1 - j / NR, inf, t, tmp); cp.setXYZ(m++, tmp.x, tmp.y + 0.08, tmp.z);
        memPos(th, 1 - (j + 1) / NR, inf, t, tmp); cp.setXYZ(m++, tmp.x, tmp.y + 0.08, tmp.z);
      }
    }
    cp.needsUpdate = true; cableLines.material.opacity = 0.55 * state.lay * clamp01(inf * 2);
  }

  var keys = [
    { p: 0.00, pos: [-40, 170, 250], tgt: [0, 0, 0] },
    { p: 0.45, pos: [140, 60, 170], tgt: [0, 10, 0] },
    { p: 0.80, pos: [44, 8, 128], tgt: [14, 13, 0] },
    { p: 1.00, pos: [38, 7, 118], tgt: [12, 14, 0] }
  ];
  var cp = new THREE.Vector3(), ct = new THREE.Vector3();
  function cameraAt(p) {
    var k = 0; while (k < keys.length - 2 && p > keys[k + 1].p) k++;
    var a = keys[k], b = keys[k + 1], t = ease(clamp01((p - a.p) / (b.p - a.p)));
    cp.set(lerp(a.pos[0], b.pos[0], t), lerp(a.pos[1], b.pos[1], t), lerp(a.pos[2], b.pos[2], t));
    ct.set(lerp(a.tgt[0], b.tgt[0], t), lerp(a.tgt[1], b.tgt[1], t), lerp(a.tgt[2], b.tgt[2], t));
    if (camera.aspect < 1) cp.sub(ct).multiplyScalar(Math.min(1.6, 0.8 / camera.aspect)).add(ct);
    camera.position.copy(cp); camera.lookAt(ct);
  }

  function renderScene() {
    updateMembrane(clock);
    cameraAt(state.p);
    if (ui.photo) {
      ui.photo.style.opacity = state.photo.toFixed(3);
      ui.photo.style.pointerEvents = state.photo > 0.6 ? 'auto' : 'none';
    }
    if (ui.note) {
      ui.note.style.opacity = (1 - state.photo).toFixed(3);
    }
    if (state.photo < 0.999 && renderer && scene && camera) {
      renderer.render(scene, camera);
    }
  }

  function frame(now) {
    raf = 0; if (!running) return; raf = requestAnimationFrame(frame);
    var dt = Math.min(0.05, (now - (lastT || now)) / 1000); lastT = now; clock += dt;
    renderScene();
  }
  function setRunning() {
    var should = started && visible && routeActive && !document.hidden;
    if (should && !running) { running = true; lastT = 0; raf = requestAnimationFrame(frame); }
    else if (!should && running) { running = false; if (raf) cancelAnimationFrame(raf); raf = 0; }
  }
  function resize() {
    if (!renderer) return;
    var w = stage.clientWidth, h = stage.clientHeight; if (!w || !h) return;
    renderer.setSize(w, h, false); camera.aspect = w / h; camera.fov = w / h < 1 ? 55 : 36; camera.updateProjectionMatrix();
  }

  function start() {
    if (started) return;
    try { renderer = K.renderer(canvas, mobile); } catch (e) { staticMode(); return; }
    scene = new THREE.Scene(); scene.fog = new THREE.FogExp2('#dcd6cb', 0.00075); renderer.toneMappingExposure = 0.9;
    camera = new THREE.PerspectiveCamera(36, 1, 1, 2000);
    buildScene(); resize();
    updateMembrane(0); cameraAt(0); K.precompile(renderer, scene, camera);
    var tl = gsap.timeline({
      paused: true,
      defaults: { ease: 'none' },
      onUpdate: renderScene
    });
    tl.to(state, { p: 1, duration: 1 }, 0)
      .to(state, { lay: 1, duration: 0.12 }, 0.06)
      .to(state, { inflate: 1, duration: 0.6, ease: 'power1.inOut' }, 0.18)
      .to(state, { photo: 1, duration: 0.16 }, 0.82);

    var sec = document.getElementById('dome');
    st = ScrollTrigger.create({
      trigger: sec,
      pin: stage,
      pinSpacing: false,
      start: 'top top',
      end: 'bottom bottom',
      scrub: 0.6,
      animation: tl,
      onUpdate: function () {
        renderScene();
      }
    });
    window.addEventListener('resize', resize);
    started = true;
    if (window.ScrollTrigger) ScrollTrigger.refresh();
    setRunning();
  }
  function staticMode() {
    var sec = document.getElementById('dome');
    if (sec) sec.classList.add('is-static');
    if (canvas) canvas.hidden = true;
    if (ui.photo) ui.photo.style.opacity = 1;
    if (ui.note) ui.note.hidden = true;
  }

  function init(reduced) {
    stage = document.querySelector('.dome-stage');
    canvas = document.getElementById('domeCanvas');
    ui = { photo: document.getElementById('domePhoto'), note: document.getElementById('domeNote') };
    if (!stage || !canvas) return;

    mobile = Math.min(window.innerWidth, window.innerHeight) < 700 || /Mobi|Android/i.test(navigator.userAgent);
    if (mobile) { NT = 80; NR = 22; }
    if (reduced || !(THREE && K && K.webgl())) { staticMode(); return; }
    if (ui.photo) ui.photo.style.opacity = 0;

    start();

    var sec = document.getElementById('dome');
    if (sec && 'IntersectionObserver' in window) {
      new IntersectionObserver(function (es) {
        es.forEach(function (e) {
          visible = e.isIntersecting;
          setRunning();
        });
      }, { rootMargin: '50% 0px 50% 0px' }).observe(sec);
    } else {
      visible = true;
      setRunning();
    }
    document.addEventListener('visibilitychange', setRunning);
  }
  return { init: init, setRouteActive: function (on) { routeActive = on; if (st) { on ? st.enable() : st.disable(false); } setRunning(); } };
})();