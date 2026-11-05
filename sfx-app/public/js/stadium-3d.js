/* =========================================================================
   SFXMEC — Tensile Roof Built Over a Conceptual Stadium (Scroll-Scrubbed)
   Extracted from sfxmec-standalone.html.
   Includes:
     - 6-bay tensile membrane grandstand roof
     - Procedural stadium pitch, stands, floodlights, palm concourse & skyline
     - Realistic cable tensioning, mast raising, and fabric unfolding
     - Afternoon sun transitioning to evening dusk glow with floodlights
     - Synchronized HUD stage captions and final CTA reveal
   ========================================================================= */
window.SFX = window.SFX || {};

SFX.stadium3d = SFX.hero3d = (function () {

  function staticMode() {
    var sec = document.getElementById('stadium') || document.getElementById('hero');
    if (sec) sec.classList.add('is-static');
    var fb = document.getElementById('stadiumFallback') || document.getElementById('heroFallback');
    if (fb) fb.hidden = false;
    var cv = document.getElementById('stadiumCanvas') || document.getElementById('heroCanvas');
    if (cv) cv.hidden = true;
    var final = document.getElementById('stadiumFinal') || document.getElementById('heroFinal');
    if (final) {
      final.classList.add('is-on');
      final.querySelectorAll('.stadium-sub, .stadium-ctas, .stadium-title, .hero-sub, .hero-ctas, .hero-title').forEach(function (el) {
        el.style.opacity = 1; el.style.transform = 'none'; el.style.clipPath = 'none';
      });
    }
    var note = sec ? sec.querySelector('.stadium-note, .hero-note') : null;
    if (note) note.textContent = 'Illustrative image';
  }

  function renderScene() {
    updateScene(clock);
    updateUI();
    if (renderer && scene && camera) {
      renderer.render(scene, camera);
    }
  }

  'use strict';
  var THREE = window.THREE, K = SFX.kit;
  var api = { ok: false };
  api.supported = function () { return !!(THREE && window.gsap && window.ScrollTrigger && K && K.webgl()); };

  /* ---------- Geometry constants (metres) ---------- */
  var BAYS = 6, X0 = -54, BW = 18;
  var Z_BACK = 29.5, Z_FRONT = -3.5, Z_MAST = 44, Z_ANCHOR = 62;
  var HB = [22, 26.5], HF = [28.5, 23.5];      // back / front corner heights, alternating by boundary parity
  var MAST_H = 46;
  function bx(k) { return X0 + BW * k; }
  function backH(k) { return HB[k % 2]; }
  function frontH(k) { return HF[k % 2]; }

  var isMobile = false, segU = 14, segV = 22;
  var renderer, scene, camera, canvas, stage, sun, hemi, floodLights = [], underGlow, lampMat;
  var skyMesh, skylineMesh, bays = [], columns = [], masts = [], beam = [], cables = { back: [], fore: [], ridge: [], front: [] };
  var running = false, raf = 0, visible = true, routeActive = true, clock = 0, lastT = 0;
  var pointer = { x: 0, y: 0, sx: 0, sy: 0 };
  var state = { p: 0, intro: 1, rise: 0, beam: 0, back: 0, fore: 0, ridge: 0, unfold: 0, front: 0, tension: 0, dusk: 0, title: 0 };
  var tl, st;

  function clamp01(x) { return x < 0 ? 0 : x > 1 ? 1 : x; }
  function ease(x) { return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2; }
  function easeOut(x) { return 1 - Math.pow(1 - x, 3); }
  function lerp(a, b, t) { return a + (b - a) * t; }
  function v3(x, y, z) { return new THREE.Vector3(x, y, z); }

  /* ---------- Membrane surface of bay i ----------
     u: 0..1 across the bay (x), v: 0 at the rear beam .. 1 at the front edge */
  function tautPos(i, u, v, out) {
    var b0 = backH(i), b1 = backH(i + 1), f0 = frontH(i), f1 = frontH(i + 1);
    var yb = lerp(b0, b1, u), yf = lerp(f0, f1, u);
    out.x = bx(i) + BW * u;
    out.z = lerp(Z_BACK, Z_FRONT, v) + 2.6 * Math.pow(v, 3) * 4 * u * (1 - u);   // front edge cable scallop
    out.y = lerp(yb, yf, v) - 0.6 * Math.sin(Math.PI * u) * Math.sin(Math.PI * v); // slight dish between cables
    return out;
  }
  var _a = new THREE.Vector3(), _b = new THREE.Vector3();
  // Unfolding + slack + wrinkles, blended to taut by tension
  function fabricPos(i, u, v, f, ten, t, out) {
    // fabric extends forward from the rear beam: v is compressed into [0, f]
    var vf = v * Math.max(f, 0.035);
    tautPos(i, u, vf, _b);
    var su = Math.sin(Math.PI * u), sv = Math.sin(Math.PI * Math.min(1, vf));
    var slackSag = 3.2 * su * sv * (1 - ten);
    // folded pleats while bunched, loose wrinkles while slack, a breath of wind
    var pleat = (1 - f) * 0.9 * Math.sin(v * 46) * su;
    var wr = (1 - ten) * (0.55 * Math.sin(u * 11 + v * 7 + t * 0.9) + 0.32 * Math.sin(u * 23 - v * 15 - t * 1.4)) * su * Math.sqrt(sv + 0.01);
    var wind = (1 - ten * 0.92) * 0.12 * Math.sin(t * 1.7 + u * 5 + v * 3);
    out.x = _b.x + (1 - ten) * 0.25 * Math.sin(v * 9 + u * 3) * su;
    out.z = _b.z;
    out.y = _b.y - slackSag + pleat + wr + wind - (1 - f) * 1.2 * vf;
    return out;
  }

  /* ---------- Build the stadium ---------- */
  function buildSetting() {
    skyMesh = K.sky(900); scene.add(skyMesh);
    skylineMesh = K.skyline(760, isMobile); scene.add(skylineMesh);
    scene.add(K.ground(1600, '#cfc2a8'));
    // apron around the pitch
    var apron = new THREE.Mesh(new THREE.PlaneGeometry(130, 90), new THREE.MeshStandardMaterial({ color: '#2f6230', roughness: 1 }));
    apron.rotation.x = -Math.PI / 2; apron.position.set(0, 0.005, -40); apron.receiveShadow = true; scene.add(apron);
    var pitch = K.pitch(renderer); pitch.position.set(0, 0.02, -40); scene.add(pitch);
    var gg = new THREE.Group(); gg.position.set(0, 0.02, -40); K.goals(gg, 52.5); scene.add(gg);

    // Main stand (gets the roof)
    var main = K.stand({ length: 120, rows: 30, rowDepth: 0.92, rise: 0.52, frontY: 1.5, seatColor: '#245585' });
    scene.add(main);
    // Opposite and end stands (lower, already built, no roof)
    var opp = K.stand({ length: 120, rows: 16, rowDepth: 0.85, rise: 0.48, seatColor: '#3b5f86' });
    opp.rotation.y = Math.PI; opp.position.set(0, 0, -80); scene.add(opp);
    [-1, 1].forEach(function (s) {
      var end = K.stand({ length: 66, rows: 14, rowDepth: 0.85, rise: 0.48, seatColor: '#3b5f86' });
      end.rotation.y = -s * Math.PI / 2; end.position.set(s * 59, 0, -40); scene.add(end);
    });
    // Floodlight towers at the four corners
    lampMat = new THREE.MeshStandardMaterial({ color: '#dfe6ef', emissive: '#fff4dc', emissiveIntensity: 0, roughness: 0.4 });
    var poleMat = new THREE.MeshStandardMaterial({ color: '#9aa3ad', metalness: 0.5, roughness: 0.4 });
    [[-72, -88], [72, -88], [-72, 8], [72, 8]].forEach(function (c) {
      var pole = new THREE.Mesh(new THREE.CylinderGeometry(0.45, 0.8, 40, 10), poleMat); pole.position.set(c[0], 20, c[1]); pole.castShadow = true; scene.add(pole);
      var head = new THREE.Mesh(new THREE.BoxGeometry(7, 4, 0.8), lampMat); head.position.set(c[0], 40.5, c[1]);
      head.lookAt(0, 0, -40); scene.add(head);
    });
    // Palms along the concourse behind the main stand, and a few people for scale
    var r = K.rng(11);
    for (var i = 0; i < 16; i++) {
      var pz = 70 + r() * 8, px = -75 + i * 10 + r() * 3;
      var palm = K.palm(8 + r() * 4); palm.position.set(px, 0, pz); scene.add(palm);
    }
    for (var j = 0; j < 14; j++) { var pp = K.person(['#33475f', '#7a4b3a', '#d8d2c4', '#26507a'][j % 4]); pp.position.set(-30 + r() * 60, 0, 52 + r() * 14); pp.rotation.y = r() * 6; scene.add(pp); }
  }

  function buildStructure() {
    var steel = new THREE.MeshStandardMaterial({ color: '#c7ccd2', metalness: 0.6, roughness: 0.35 });
    var cableMat = new THREE.MeshStandardMaterial({ color: '#5c6672', metalness: 0.8, roughness: 0.3 });
    for (var k = 0; k <= BAYS; k++) {
      // rear columns carrying the back corners
      var hb = backH(k), cg = new THREE.CylinderGeometry(0.32, 0.4, hb, 12); cg.translate(0, hb / 2, 0);
      var col = new THREE.Mesh(cg, steel); col.position.set(bx(k), 0, Z_BACK); col.scale.y = 0.001; col.castShadow = true; scene.add(col); columns.push(col);
      // masts behind the stand, slightly raked back
      var mg = new THREE.CylinderGeometry(0.45, 0.75, MAST_H, 14); mg.translate(0, MAST_H / 2, 0);
      var mast = new THREE.Mesh(mg, steel); mast.position.set(bx(k), 0, Z_MAST); mast.rotation.x = 0.06; mast.scale.y = 0.001; mast.castShadow = true; scene.add(mast); masts.push(mast);
      var head = mastHead(k);
      // backstays (two per mast) and forestays (to the front corner)
      [-6, 6].forEach(function (dx) { cables.back.push(K.tube([head, head.clone().lerp(v3(bx(k) + dx, 0.3, Z_ANCHOR), 0.5), v3(bx(k) + dx, 0.3, Z_ANCHOR)], 0.09, cableMat, 24)); });
      var fc = v3(bx(k), frontH(k), Z_FRONT);
      var mid = head.clone().lerp(fc, 0.5); mid.y -= 1.2;
      cables.fore.push(K.tube([head, mid, fc], 0.08, cableMat, 48));
      // ridge / valley cable along the boundary line from rear beam to front corner
      var pts = []; for (var s = 0; s <= 12; s++) pts.push(v3(bx(k), lerp(backH(k), frontH(k), s / 12) + 0.08, lerp(Z_BACK, Z_FRONT, s / 12)));
      cables.ridge.push(K.tube(pts, 0.07, cableMat, 24));
    }
    // rear beam (one tube per bay between column heads)
    for (var i = 0; i < BAYS; i++) {
      beam.push(K.tube([v3(bx(i), backH(i), Z_BACK), v3(bx(i) + BW / 2, (backH(i) + backH(i + 1)) / 2, Z_BACK), v3(bx(i + 1), backH(i + 1), Z_BACK)], 0.35, steel, 16));
      // scalloped front edge cable
      var fp = []; for (var q = 0; q <= 16; q++) fp.push(tautPos(i, q / 16, 1, new THREE.Vector3()));
      cables.front.push(K.tube(fp, 0.07, cableMat, 32));
    }
    [].concat(beam, cables.back, cables.fore, cables.ridge, cables.front).forEach(function (m) { scene.add(m); });

    // Membrane bays
    // PTFE-like: bright, slightly translucent (a little self-light so the underside never goes grey)
    var mat = new THREE.MeshStandardMaterial({ color: '#fbf9f4', roughness: 0.55, metalness: 0, side: THREE.DoubleSide, emissive: '#fff1dc', emissiveIntensity: 0.42 });
    for (var b = 0; b < BAYS; b++) {
      var geo = new THREE.PlaneGeometry(1, 1, segU, segV);
      var mesh = new THREE.Mesh(geo, mat);
      mesh.castShadow = true; mesh.receiveShadow = true; mesh.visible = false; mesh.frustumCulled = false;
      scene.add(mesh); bays.push(mesh);
    }
  }
  function mastHead(k) { return v3(bx(k), MAST_H * Math.cos(0.06), Z_MAST + MAST_H * Math.sin(0.06)); }

  var lastKey = '';
  function updateFabric(t) {
    var unf = state.unfold, ten = ease(state.tension);
    var animating = unf > 0.001 && ten < 0.999;
    var key = unf.toFixed(4) + '|' + ten.toFixed(4);
    if (!animating && key === lastKey) return;
    lastKey = key;
    var stagger = 0.11, span = 1 - (BAYS - 1) * stagger;
    // unfold outward from the centre bays, like a crew working both ways
    var order = [2, 3, 1, 4, 0, 5];
    for (var b = 0; b < BAYS; b++) {
      var mesh = bays[b], f = easeOut(clamp01((unf - order.indexOf(b) * stagger) / span));
      mesh.visible = f > 0.001;
      if (!mesh.visible) continue;
      var pos = mesh.geometry.attributes.position, n = 0;
      for (var iy = 0; iy <= segV; iy++) for (var ix = 0; ix <= segU; ix++) {
        fabricPos(b, ix / segU, iy / segV, f, ten, t, _a);
        pos.setXYZ(n++, _a.x, _a.y, _a.z);
      }
      pos.needsUpdate = true; mesh.geometry.computeVertexNormals();
    }
  }

  /* ---------- Lighting ---------- */
  function buildLights() {
    hemi = new THREE.HemisphereLight('#bcd2ec', '#9c8a6c', 0.45); scene.add(hemi);
    sun = new THREE.DirectionalLight('#ffe2bc', 2.7);
    sun.position.set(-120, 150, -170); sun.target.position.set(0, 0, 0);
    sun.castShadow = true;
    var s = isMobile ? 1024 : 2048;
    sun.shadow.mapSize.set(s, s);
    var sc = sun.shadow.camera; sc.left = -110; sc.right = 110; sc.top = 110; sc.bottom = -110; sc.near = 50; sc.far = 520;
    sun.shadow.bias = -0.0004; sun.shadow.normalBias = 0.6; sun.shadow.radius = 4;
    scene.add(sun); scene.add(sun.target);
    // dusk lights: floodlights over the pitch and a warm uplight under the roof
    [[-45, 40, -60], [45, 40, -60]].forEach(function (p) { var l = new THREE.PointLight('#fff1d8', 0, 180, 1.4); l.position.set(p[0], p[1], p[2]); scene.add(l); floodLights.push(l); });
    underGlow = new THREE.PointLight('#ffb867', 0, 90, 1.2); underGlow.position.set(0, 12, 12); scene.add(underGlow);
  }
  var _glowDay = new THREE.Color('#fff1dc'), _glowDusk = new THREE.Color('#ffb25a');
  var _dayFog = new THREE.Color('#dcd6cb'), _duskFog = new THREE.Color('#3d3f5c'), _sunDay = new THREE.Color('#ffe6c4'), _sunDusk = new THREE.Color('#ff9a52');

  /* ---------- Camera path ---------- */
  var camKeys = [
    { p: 0.00, pos: [-125, 92, -150], tgt: [0, 8, 0] },
    { p: 0.12, pos: [-95, 52, -112], tgt: [0, 12, 4] },
    { p: 0.30, pos: [62, 26, -58], tgt: [0, 22, 18] },
    { p: 0.48, pos: [-52, 34, -48], tgt: [0, 24, 14] },
    { p: 0.64, pos: [22, 8.5, -30], tgt: [-4, 20, 6] },
    { p: 0.80, pos: [-34, 13, -62], tgt: [0, 17, 6] },
    { p: 0.92, pos: [4, 17, -104], tgt: [0, 15, 4] },
    { p: 1.00, pos: [10, 13, -90], tgt: [0, 16, 4] }
  ];
  var _cp = new THREE.Vector3(), _ct = new THREE.Vector3();
  function cameraAt(p) {
    var k = 0; while (k < camKeys.length - 2 && p > camKeys[k + 1].p) k++;
    var a = camKeys[k], b = camKeys[k + 1], t = ease(clamp01((p - a.p) / (b.p - a.p)));
    _cp.set(lerp(a.pos[0], b.pos[0], t), lerp(a.pos[1], b.pos[1], t), lerp(a.pos[2], b.pos[2], t));
    _ct.set(lerp(a.tgt[0], b.tgt[0], t), lerp(a.tgt[1], b.tgt[1], t), lerp(a.tgt[2], b.tgt[2], t));
    if (camera.aspect < 1) { _cp.sub(_ct).multiplyScalar(lerp(Math.min(1.45, 0.75 / camera.aspect), 0.82, clamp01((p - 0.78) / 0.14))).add(_ct); _ct.y += 0; }
    camera.position.copy(_cp);
    camera.position.x += pointer.sx * 2.5; camera.position.y += pointer.sy * 1.4;
    camera.lookAt(_ct);
  }

  /* ---------- Master timeline ---------- */
  function buildTimeline(heroEl) {
    tl = gsap.timeline({ paused: true, defaults: { ease: 'none' } });
    tl.to(state, { p: 1, duration: 1 }, 0)
      .to(state, { intro: 0, duration: 0.05 }, 0)
      .to(state, { rise: 1, duration: 0.2, ease: 'power1.inOut' }, 0.12)
      .to(state, { beam: 1, duration: 0.08 }, 0.28)
      .to(state, { back: 1, duration: 0.09 }, 0.31)
      .to(state, { fore: 1, duration: 0.1 }, 0.36)
      .to(state, { ridge: 1, duration: 0.07 }, 0.43)
      .to(state, { unfold: 1, duration: 0.18, ease: 'power1.inOut' }, 0.50)
      .to(state, { front: 1, duration: 0.06 }, 0.64)
      .to(state, { tension: 1, duration: 0.16, ease: 'power1.inOut' }, 0.66)
      .to(state, { dusk: 1, duration: 0.14, ease: 'power1.inOut' }, 0.80)
      .to(state, { title: 1, duration: 0.05 }, 0.94);
    st = ScrollTrigger.create({
      trigger: heroEl,
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
  }

  /* ---------- Per frame ---------- */
  var ui = {}, cache = {};
  var CAP_AT = [0, 0.12, 0.30, 0.50, 0.66, 0.82];
  function updateScene(t) {
    var p = state.p;
    // columns + masts rise (staggered from the centre out)
    for (var k = 0; k <= BAYS; k++) {
      var d = Math.abs(k - BAYS / 2) / (BAYS / 2);
      var e = easeOut(clamp01(state.rise * 1.5 - d * 0.5));
      columns[k].scale.y = Math.max(0.001, easeOut(clamp01(state.rise * 1.8 - d * 0.4)));
      masts[k].scale.y = Math.max(0.001, e);
    }
    beam.forEach(function (m, i) { K.drawTube(m, clamp01(state.beam * 1.6 - Math.abs(i - 2.5) * 0.12)); });
    cables.back.forEach(function (m, i) { K.drawTube(m, clamp01(state.back * 1.5 - (i % 7) * 0.05)); });
    cables.fore.forEach(function (m, i) { K.drawTube(m, clamp01(state.fore * 1.6 - Math.abs(i - 3) * 0.12)); });
    cables.ridge.forEach(function (m, i) { K.drawTube(m, clamp01(state.ridge * 1.6 - Math.abs(i - 3) * 0.12)); });
    cables.front.forEach(function (m, i) { K.drawTube(m, clamp01(state.front * 1.5 - Math.abs(i - 2.5) * 0.1)); });
    updateFabric(t);

    // light: afternoon -> dusk
    var D = state.dusk;
    skyMesh.material.uniforms.uDusk.value = D;
    sun.intensity = lerp(2.7, 0.12, D); sun.color.copy(_sunDay).lerp(_sunDusk, D);
    hemi.intensity = lerp(0.45, 0.16, D);
    scene.fog.color.copy(_dayFog).lerp(_duskFog, D);
    floodLights.forEach(function (l) { l.intensity = D * 2.1; });
    underGlow.intensity = D * 2.8;
    lampMat.emissiveIntensity = D * 2.2;
    if (bays.length) { bays[0].material.emissiveIntensity = 0.42 + D * 0.6; bays[0].material.emissive.copy(_glowDay).lerp(_glowDusk, D); }
    skylineMesh.material.color.setRGB(lerp(0.66, 0.1, D), lerp(0.72, 0.1, D), lerp(0.8, 0.17, D));
    renderer.toneMappingExposure = lerp(0.95, 1.1, D);
    cameraAt(p);
  }

  function updateUI() {
    var p = state.p;
    var cap = -1; for (var i = 0; i < CAP_AT.length; i++) if (p >= CAP_AT[i]) cap = i;
    if (state.title > 0.2) cap = -1;
    if (cache.cap !== cap) { cache.cap = cap; ui.caps.forEach(function (c) { c.classList.toggle('is-on', +c.getAttribute('data-cap') === cap); }); }
    var io = 1 - clamp01(p / 0.05);
    if (cache.io !== io) {
      cache.io = io; ui.intro.style.opacity = io.toFixed(3); ui.intro.style.transform = 'translateY(' + ((1 - io) * -24).toFixed(1) + 'px)';
      ui.intro.style.visibility = io > 0 ? 'visible' : 'hidden'; ui.scroll.classList.toggle('is-gone', p > 0.02);
    }
    var tt = state.title;
    if (cache.tt !== tt) {
      cache.tt = tt;
      var e = easeOut(tt);
      ui.stage.style.setProperty('--scrim', clamp01(state.dusk * 0.6 + tt * 0.4).toFixed(3));
      ui.title.style.clipPath = 'inset(0 0 ' + ((1 - e) * 100).toFixed(2) + '% 0)';
      ui.title.style.transform = 'translateY(' + ((1 - e) * 0.35).toFixed(3) + 'em)';
      ui.fades.forEach(function (el, i) { var ee = easeOut(clamp01(tt * 1.4 - 0.25 - i * 0.12)); el.style.opacity = ee; el.style.transform = 'translateY(' + ((1 - ee) * 16).toFixed(1) + 'px)'; });
      ui.final.classList.toggle('is-on', tt > 0.6); ui.final.setAttribute('aria-hidden', tt > 0.6 ? 'false' : 'true');
      ui.ctas.forEach(function (a) { a.tabIndex = tt > 0.6 ? 0 : -1; });
    }
    ui.stage.style.setProperty('--scrim', clamp01(state.dusk * 0.6 + state.title * 0.4).toFixed(3));
  }

  function frame(now) {
    raf = 0; if (!running) return;
    raf = requestAnimationFrame(frame);
    var dt = Math.min(0.05, (now - (lastT || now)) / 1000); lastT = now; clock += dt;
    pointer.sx += (pointer.x - pointer.sx) * 0.04; pointer.sy += (pointer.y - pointer.sy) * 0.04;
    updateScene(clock); updateUI();
    renderer.render(scene, camera);
  }
  function setRunning() {
    var should = visible && routeActive && !document.hidden;
    if (should && !running) { running = true; lastT = 0; raf = requestAnimationFrame(frame); }
    else if (!should && running) { running = false; if (raf) cancelAnimationFrame(raf); raf = 0; }
  }
  function resize() {
    var w = stage.clientWidth, h = stage.clientHeight; if (!w || !h) return;
    renderer.setSize(w, h, false); camera.aspect = w / h; camera.fov = w / h < 1 ? 55 : 38; camera.updateProjectionMatrix();
    if (!running) { updateScene(clock); renderer.render(scene, camera); }
  }

  api.init = function (reduced) {
    if (reduced || !api.supported()) { staticMode(); return false; }
    stage = document.querySelector('.stadium-stage') || document.querySelector('.hero-stage');
    canvas = document.getElementById('stadiumCanvas') || document.getElementById('heroCanvas');
    var heroEl = document.getElementById('stadium') || document.getElementById('hero');
    if (!stage || !canvas || !heroEl) return false;
    isMobile = Math.min(window.innerWidth, window.innerHeight) < 700 || /Mobi|Android/i.test(navigator.userAgent);
    if (isMobile) { segU = 10; segV = 16; }
    try { renderer = K.renderer(canvas, isMobile); } catch (e) { return false; }
    renderer.setClearColor('#e9e2d4');
    scene = new THREE.Scene(); scene.fog = new THREE.FogExp2('#dcd6cb', 0.0011);
    camera = new THREE.PerspectiveCamera(38, 1, 1, 2000);
    buildLights(); buildSetting(); buildStructure();

    ui = {
      stage: stage,
      caps: [].slice.call(document.querySelectorAll('#stadiumCaption p, #heroCaption p')),
      intro: document.getElementById('stadiumIntro') || document.getElementById('heroIntro'),
      scroll: document.getElementById('stadiumScroll') || document.getElementById('heroScroll'),
      title: document.querySelector('.stadium-title, .hero-title'),
      final: document.getElementById('stadiumFinal') || document.getElementById('heroFinal'),
      fades: [].slice.call(document.querySelectorAll('.stadium-sub, .stadium-ctas, .hero-sub, .hero-ctas')),
      ctas: [].slice.call(document.querySelectorAll('.stadium-ctas a, .hero-ctas a'))
    };
    ui.fades.forEach(function (el) { el.style.opacity = 0; });

    buildTimeline(heroEl);
    resize();
    window.addEventListener('resize', resize);
    if ('ResizeObserver' in window) new ResizeObserver(resize).observe(stage);
    new IntersectionObserver(function (es) { visible = es[0].isIntersecting; setRunning(); }, { rootMargin: '50px' }).observe(heroEl);
    document.addEventListener('visibilitychange', setRunning);
    if (window.matchMedia('(pointer: fine)').matches) window.addEventListener('pointermove', function (e) { pointer.x = (e.clientX / innerWidth - 0.5) * 2; pointer.y = -(e.clientY / innerHeight - 0.5) * 2; }, { passive: true });

    // Pre-compile all materials (incl. hidden fabric/cables) so nothing stalls mid-scroll
    updateScene(0); K.precompile(renderer, scene, camera);
    updateUI(); renderer.render(scene, camera);
    setRunning();
    api.ok = true; return true;
  };
  api.setRouteActive = function (on) { routeActive = on; if (st) { on ? st.enable() : st.disable(false); } setRunning(); };
  api.state = state;
  return api;
})();