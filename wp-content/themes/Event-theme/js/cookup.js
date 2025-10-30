document.addEventListener("DOMContentLoaded", function () {
  const burger = document.getElementById("burger");
  const nav = document.getElementById("main-nav");

  // Opening/closing the burger menu
  burger.addEventListener("click", function () {
    nav.classList.toggle("active");
  });

  // Close the menu when clicking outside it
  document.addEventListener("click", function (e) {
    const isClickInsideMenu = nav.contains(e.target);
    const isClickOnBurger = burger.contains(e.target);

    if (!isClickInsideMenu && !isClickOnBurger) {
      nav.classList.remove("active");
    }
  });

  // For mobile: opening a submenu
  const hasChildren = document.querySelectorAll(".menu-item-has-children > a");

  hasChildren.forEach((link) => {
    link.addEventListener("click", function (e) {
      if (window.innerWidth <= 840) {
        e.preventDefault(); // Blocks link navigation
        const parent = this.parentElement;
        parent.classList.toggle("open"); // Adds/removes a class
      }
    });
  });
});


const canvas = document.getElementById('heroCanvas');
const ctx = canvas.getContext('2d');

let width = canvas.width = window.innerWidth;
let height = canvas.height = window.innerHeight;

// === ПАРАМЕТРИ ===
const particleCount = 80;       // Кількість точок
const maxDistance = 200;        // Максимальна відстань для ліній
const pointColor = "#3498db";   // Колір точок
const lineColor = "#2c3e50";    // Колір ліній
const speed = 1.2;              // Швидкість руху точок
// =================

const particles = [];
const mouse = { x: null, y: null };

// створюємо точки
for (let i = 0; i < particleCount; i++) {
  particles.push({
    x: Math.random() * width,
    y: Math.random() * height,
    vx: (Math.random() - 0.5) * speed,
    vy: (Math.random() - 0.5) * speed
  });
}

// слідкуємо за мишкою
canvas.addEventListener('mousemove', (e) => {
  mouse.x = e.clientX;
  mouse.y = e.clientY;
});
canvas.addEventListener('mouseleave', () => {
  mouse.x = null;
  mouse.y = null;
});

function draw() {
  ctx.clearRect(0, 0, width, height);

  // малюємо точки
  particles.forEach(p => {
    ctx.beginPath();
    ctx.arc(p.x, p.y, 3, 0, Math.PI * 2);
    ctx.fillStyle = pointColor;
    ctx.fill();
  });

  // малюємо лінії між точками
  for (let i = 0; i < particleCount; i++) {
    for (let j = i + 1; j < particleCount; j++) {
      let dx = particles[i].x - particles[j].x;
      let dy = particles[i].y - particles[j].y;
      let dist = Math.sqrt(dx*dx + dy*dy);
      if (dist < maxDistance) {
        ctx.beginPath();
        ctx.moveTo(particles[i].x, particles[i].y);
        ctx.lineTo(particles[j].x, particles[j].y);
        ctx.strokeStyle = `rgba(44,62,80,${1 - dist/maxDistance})`; // лінії можна зробити прозорими
        ctx.stroke();
      }
    }
  }

  // лінії до курсору
  if (mouse.x !== null && mouse.y !== null) {
    particles.forEach(p => {
      let dx = p.x - mouse.x;
      let dy = p.y - mouse.y;
      let dist = Math.sqrt(dx*dx + dy*dy);
      if (dist < maxDistance) {
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
        ctx.lineTo(mouse.x, mouse.y);
        ctx.strokeStyle = `rgba(44,62,80,${1 - dist/maxDistance})`;
        ctx.stroke();
      }
    });
  }

  // рух точок
  particles.forEach(p => {
    p.x += p.vx;
    p.y += p.vy;

    if (p.x < 0 || p.x > width) p.vx *= -1;
    if (p.y < 0 || p.y > height) p.vy *= -1;
  });

  requestAnimationFrame(draw);
}

draw();

// адаптивність при зміні розміру вікна
window.addEventListener('resize', () => {
  width = canvas.width = window.innerWidth;
  height = canvas.height = window.innerHeight;
});