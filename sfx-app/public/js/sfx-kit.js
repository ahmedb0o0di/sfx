/* ======================== */
window.SFX = window.SFX || {};

SFX.kit = (function () {
  'use strict';
  var THREE = window.THREE;

  function canvas(w, h) { var c = document.createElement('canvas'); c.width = w; c.height = h; return c; }
  function rng(seed) { var s = seed; return function () { s = (s * 16807) % 2147483647; return (s - 1) / 2147483646; }; }

  /* ---------- Football pitch with mowing stripes and markings (105 x 68 m) ---------- */
  function pitchTexture(renderer) {
    var W = 1600, H = 1040, m = W / 113;  // 113 x 73.5 m including run-off
    var c = canvas(W, H), g = c.getContext('2d');
    g.fillStyle = '#356b32'; g.fillRect(0, 0, W, H);
    var ox = 4 * m, oy = 2.75 * m, pw = 105 * m, ph = 68 * m;
    for (var i = 0; i < 18; i++) { g.fillStyle = i % 2 ? '#386f33' : '#3f7c39'; g.fillRect(ox + i * pw / 18, oy, pw / 18 + 1, ph); }
    var r = rng(5); // subtle turf noise
    for (var k = 0; k < 9000; k++) { g.fillStyle = 'rgba(' + (r() > 0.5 ? '255,255,255' : '0,0,0') + ',0.035)'; g.fillRect(r() * W, r() * H, 2, 2); }
    g.strokeStyle = 'rgba(255,255,255,0.92)'; g.lineWidth = Math.max(2, 0.12 * m);
    g.strokeRect(ox, oy, pw, ph);
    g.beginPath(); g.moveTo(ox + pw / 2, oy); g.lineTo(ox + pw / 2, oy + ph); g.stroke();
    g.beginPath(); g.arc(ox + pw / 2, oy + ph / 2, 9.15 * m, 0, Math.PI * 2); g.stroke();
    g.fillStyle = '#fff'; g.beginPath(); g.arc(ox + pw / 2, oy + ph / 2, 0.3 * m, 0, Math.PI * 2); g.fill();
    [0, 1].forEach(function (side) {
      var x = side ? ox + pw : ox, d = side ? -1 : 1;
      g.strokeRect(Math.min(x, x + d * 16.5 * m), oy + ph / 2 - 20.16 * m, 16.5 * m, 40.32 * m);
      g.strokeRect(Math.min(x, x + d * 5.5 * m), oy + ph / 2 - 9.16 * m, 5.5 * m, 18.32 * m);
      g.beginPath(); g.arc(x + d * 11 * m, oy + ph / 2, 0.3 * m, 0, Math.PI * 2); g.fill();
      g.beginPath(); g.arc(x + d * 11 * m, oy + ph / 2, 9.15 * m, side ? Math.PI - 0.93 : -0.93, side ? Math.PI + 0.93 : 0.93); g.stroke();
    });
    var t = new THREE.CanvasTexture(c); t.encoding = THREE.sRGBEncoding;
    if (renderer) t.anisotropy = Math.min(8, renderer.capabilities.getMaxAnisotropy());
    return t;
  }
  function pitch(renderer) {
    var mesh = new THREE.Mesh(new THREE.PlaneGeometry(113, 73.5), new THREE.MeshStandardMaterial({ map: pitchTexture(renderer), roughness: 0.95 }));
    mesh.rotation.x = -Math.PI / 2; mesh.receiveShadow = true;
    return mesh;
  }
  function goals(group, halfLength) {
    var mat = new THREE.MeshStandardMaterial({ color: '#ffffff', roughness: 0.4 });
    [-1, 1].forEach(function (s) {
      var g = new THREE.Group();
      var post = new THREE.CylinderGeometry(0.06, 0.06, 2.44, 8);
      var p1 = new THREE.Mesh(post, mat); p1.position.set(0, 1.22, -3.66);
      var p2 = new THREE.Mesh(post, mat); p2.position.set(0, 1.22, 3.66);
      var bar = new THREE.Mesh(new THREE.CylinderGeometry(0.06, 0.06, 7.32, 8), mat); bar.rotation.x = Math.PI / 2; bar.position.set(0, 2.44, 0);
      g.add(p1, p2, bar); g.position.x = s * halfLength;
      g.traverse(function (o) { o.castShadow = true; });
      group.add(g);
    });
  }

  /* ---------- Seating stand: stepped concrete body + seat rows ----------
     Local frame: front edge at z = 0 facing -z (towards the pitch), rows climb towards +z. */
  var seatTex = null;
  function seatTexture(color) {
    var c = canvas(64, 32), g = c.getContext('2d');
    g.fillStyle = '#8e9299'; g.fillRect(0, 0, 64, 32);
    g.fillStyle = color; g.beginPath();
    if (g.roundRect) g.roundRect(6, 3, 52, 26, 6); else g.rect(6, 3, 52, 26);
    g.fill();
    g.fillStyle = 'rgba(255,255,255,.22)'; g.fillRect(10, 5, 44, 5);
    var t = new THREE.CanvasTexture(c); t.wrapS = THREE.RepeatWrapping; t.encoding = THREE.sRGBEncoding;
    return t;
  }
  function stand(o) {
    var rows = o.rows, rd = o.rowDepth || 0.85, rise = o.rise || 0.48, y0 = o.frontY || 1.4, len = o.length;
    var grp = new THREE.Group();
    var shape = new THREE.Shape();
    shape.moveTo(0, 0); shape.lineTo(0, y0);
    for (var i = 0; i < rows; i++) { shape.lineTo(-(i * rd), y0 + i * rise); shape.lineTo(-((i + 1) * rd), y0 + i * rise); }
    var backZ = rows * rd + (o.backPad || 0.6), topY = y0 + rows * rise + (o.wall || 1.4);
    shape.lineTo(-backZ, y0 + (rows - 1) * rise); shape.lineTo(-backZ, topY); shape.lineTo(-backZ - 0.5, topY); shape.lineTo(-backZ - 0.5, 0); shape.lineTo(0, 0);
    var geo = new THREE.ExtrudeGeometry(shape, { depth: len, bevelEnabled: false, steps: 1 });
    geo.rotateY(Math.PI / 2); geo.translate(-len / 2, 0, 0);
    var body = new THREE.Mesh(geo, new THREE.MeshStandardMaterial({ color: o.concrete || '#d8d3ca', roughness: 0.9 }));
    body.castShadow = true; body.receiveShadow = true; grp.add(body);
    // seat rows (one instanced box per row, seat texture repeated along the row)
    var tex = seatTexture(o.seatColor || '#1d5c9e');
    tex.repeat.set(Math.round(len / 0.55), 1);
    var seatGeo = new THREE.BoxGeometry(len - 1, 0.42, 0.5);
    var seats = new THREE.InstancedMesh(seatGeo, new THREE.MeshStandardMaterial({ map: tex, roughness: 0.6 }), rows);
    var mtx = new THREE.Matrix4();
    for (var r = 0; r < rows; r++) { mtx.makeTranslation(0, y0 + r * rise + 0.21, (r + 0.62) * rd); seats.setMatrixAt(r, mtx); }
    seats.receiveShadow = true; seats.castShadow = false; grp.add(seats);
    // aisles: light concrete stair strips every ~18 m
    var aisleMat = new THREE.MeshStandardMaterial({ color: '#e6e1d8', roughness: 0.9 });
    for (var x = -len / 2 + 9; x < len / 2 - 4; x += 18) {
      var a = new THREE.Mesh(new THREE.BoxGeometry(1.2, 0.5, rows * rd), aisleMat);
      var ang = Math.atan2(rows * rise, rows * rd);
      a.scale.z = 1 / Math.cos(ang); a.rotation.x = -ang;
      a.position.set(x, y0 + rows * rise / 2 + 0.25, rows * rd / 2); a.receiveShadow = true; grp.add(a);
    }
    grp.userData = { backZ: backZ, topY: topY, depth: rows * rd };
    return grp;
  }

  /* ---------- Palm tree (scale cue) ---------- */
  var palmMats = null;
  function palm(h) {
    if (!palmMats) palmMats = { trunk: new THREE.MeshStandardMaterial({ color: '#8a6e4b', roughness: 1 }), leaf: new THREE.MeshStandardMaterial({ color: '#4f7a34', roughness: 0.8, side: THREE.DoubleSide }) };
    var g = new THREE.Group(); h = h || 9;
    var trunk = new THREE.Mesh(new THREE.CylinderGeometry(0.22, 0.36, h, 7), palmMats.trunk); trunk.position.y = h / 2; trunk.castShadow = true; g.add(trunk);
    var leafGeo = new THREE.PlaneGeometry(4.2, 0.9, 6, 1);
    var pos = leafGeo.attributes.position;
    for (var i = 0; i < pos.count; i++) { var x = pos.getX(i); pos.setY(i, pos.getY(i) * (1 - Math.abs(x) / 2.4)); pos.setZ(i, -0.12 * x * x); }
    leafGeo.translate(2.1, 0, 0); leafGeo.computeVertexNormals();
    for (var k = 0; k < 9; k++) {
      var leaf = new THREE.Mesh(leafGeo, palmMats.leaf);
      leaf.position.y = h; leaf.rotation.set(-Math.PI / 2 + 0.5, 0, 0); leaf.rotation.y = k / 9 * Math.PI * 2;
      leaf.rotateX(0.35); leaf.castShadow = true; g.add(leaf);
    }
    return g;
  }
  /* ---------- Person (1.75 m scale cue) ---------- */
  function person(color) {
    var g = new THREE.Group(), m = new THREE.MeshStandardMaterial({ color: color || '#33475f', roughness: 0.8 });
    var body = new THREE.Mesh(new THREE.CylinderGeometry(0.2, 0.17, 1.35, 8), m); body.position.y = 0.68;
    var head = new THREE.Mesh(new THREE.SphereGeometry(0.13, 10, 8), new THREE.MeshStandardMaterial({ color: '#c79f7e', roughness: 0.8 })); head.position.y = 1.55;
    g.add(body, head); g.traverse(function (o) { o.castShadow = true; });
    return g;
  }

  /* ---------- Sky dome: day -> dusk ---------- */
  function sky(radius) {
    var mat = new THREE.ShaderMaterial({
      side: THREE.BackSide, depthWrite: false, fog: false,
      uniforms: {
        uDusk: { value: 0 }, uSun: { value: new THREE.Vector3(-0.4, 0.35, -0.85).normalize() },
        uZenD: { value: new THREE.Color('#5d8fc7') }, uHorD: { value: new THREE.Color('#e9e2d4') },
        uZenN: { value: new THREE.Color('#1b2b52') }, uHorN: { value: new THREE.Color('#e48a52') }, uMidN: { value: new THREE.Color('#6a5d84') }
      },
      vertexShader: 'varying vec3 vW; void main(){ vW = (modelMatrix*vec4(position,1.0)).xyz; gl_Position = projectionMatrix*viewMatrix*vec4(vW,1.0); }',
      fragmentShader: [
        'uniform float uDusk; uniform vec3 uSun, uZenD, uHorD, uZenN, uHorN, uMidN; varying vec3 vW;',
        'void main(){',
        '  vec3 d = normalize(vW); float h = max(d.y, 0.0);',
        '  vec3 day = mix(uHorD, uZenD, pow(smoothstep(0.0, 0.7, h), 0.8));',
        '  vec3 dusk = mix(uHorN, uMidN, smoothstep(0.0, 0.18, h)); dusk = mix(dusk, uZenN, smoothstep(0.15, 0.75, h));',
        '  float s = max(dot(d, normalize(uSun)), 0.0);',
        '  vec3 col = mix(day, dusk, uDusk);',
        '  col += vec3(1.0, 0.86, 0.62) * (pow(s, 600.0) * (1.0 - uDusk) * 1.4 + pow(s, 8.0) * 0.22 + pow(s, 2.0) * 0.08 * uDusk);',
        '  col = mix(col, mix(vec3(0.82,0.78,0.72), vec3(0.18,0.16,0.22), uDusk), smoothstep(0.0, -0.05, d.y));',
        '  gl_FragColor = vec4(col, 1.0);',
        '}'
      ].join('\n')
    });
    return new THREE.Mesh(new THREE.SphereGeometry(radius || 900, 32, 16), mat);
  }

  /* ---------- Distant skyline silhouette (hazy by day, lit windows at dusk) ---------- */
  function skyline(radius, mobile) {
    var w = mobile ? 2048 : 4096, h = 512, c = canvas(w, h), g = c.getContext('2d', { willReadFrequently: true });
    var r = rng(1937), base = h - 2, s = w / 4096;
    g.fillStyle = '#ffffff';
    for (var x = 0; x < w;) { var bw = (18 + r() * 60) * s, bh = 14 + Math.pow(r(), 2.4) * 140; g.fillRect(x, base - bh, bw, bh); x += bw + r() * 14 * s; }
    var cx = w * 0.42;
    for (var k = 0; k < 16; k++) g.fillRect(cx + (r() - 0.5) * w * 0.14, base - (110 + r() * 170), (22 + r() * 40) * s, 400);
    g.beginPath(); g.moveTo(cx - 30 * s, base); g.lineTo(cx - 20 * s, base - 220); g.lineTo(cx - 10 * s, base - 330); g.lineTo(cx - 2 * s, base - 470);
    g.lineTo(cx + 2 * s, base - 470); g.lineTo(cx + 12 * s, base - 300); g.lineTo(cx + 30 * s, base); g.fill();
    var tex = new THREE.CanvasTexture(c); tex.encoding = THREE.sRGBEncoding;
    var mat = new THREE.MeshBasicMaterial({ map: tex, transparent: true, color: '#b9c3cf', side: THREE.BackSide, depthWrite: false, fog: false });
    var mesh = new THREE.Mesh(new THREE.CylinderGeometry(radius, radius, radius * 0.22, 64, 1, true), mat);
    mesh.position.y = radius * 0.07 - 2; mesh.scale.y = 0.62; mat.opacity = 0.75;
    return mesh;
  }

  function ground(size, color) {
    var m = new THREE.Mesh(new THREE.PlaneGeometry(size, size), new THREE.MeshStandardMaterial({ color: color || '#cdbfa6', roughness: 1 }));
    m.rotation.x = -Math.PI / 2; m.position.y = -0.02; m.receiveShadow = true; return m;
  }

  // Thin tube with partial draw (index draw range); returns mesh with userData.total
  function tube(points, radius, mat, tubular) {
    var curve = new THREE.CatmullRomCurve3(points);
    var tb = tubular || 48, rad = 6;
    var geo = new THREE.TubeGeometry(curve, tb, radius, rad, false);
    geo.setDrawRange(0, 0);
    var mesh = new THREE.Mesh(geo, mat); mesh.castShadow = true;
    mesh.userData.total = tb * rad * 6; mesh.userData.step = rad * 6;
    return mesh;
  }
  function drawTube(mesh, p) {
    var n = Math.floor(mesh.userData.total * Math.max(0, Math.min(1, p)) / mesh.userData.step) * mesh.userData.step;
    mesh.geometry.setDrawRange(0, n); mesh.visible = n > 0;
  }

  function webgl() {
    try { var c = document.createElement('canvas'); return !!(window.WebGLRenderingContext && (c.getContext('webgl2') || c.getContext('webgl'))); } catch (e) { return false; }
  }
  function renderer(canvasEl, mobile) {
    var r = new THREE.WebGLRenderer({ canvas: canvasEl, antialias: (window.devicePixelRatio || 1) < 1.5, alpha: false, powerPreference: 'high-performance' });
    r.setPixelRatio(Math.min(window.devicePixelRatio || 1, 1.5));
    r.outputEncoding = THREE.sRGBEncoding;
    r.toneMapping = THREE.ACESFilmicToneMapping; r.toneMappingExposure = 1.0;
    r.shadowMap.enabled = true; r.shadowMap.type = THREE.PCFSoftShadowMap;
    return r;
  }
  function precompile(r, scene, camera) {
    var hidden = [];
    scene.traverse(function (o) { if (!o.visible) { hidden.push(o); o.visible = true; } });
    try { r.compile(scene, camera); } catch (e) { }
    hidden.forEach(function (o) { o.visible = false; });
  }

  return { pitch: pitch, goals: goals, stand: stand, palm: palm, person: person, sky: sky, skyline: skyline, ground: ground,
    tube: tube, drawTube: drawTube, webgl: webgl, renderer: renderer, precompile: precompile, rng: rng };
})();