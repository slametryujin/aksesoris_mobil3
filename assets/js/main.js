// small helper JS (navigation toggle, sticky blur, outside-close, hero parallax, accessibility)
document.addEventListener('DOMContentLoaded', function(){
  const nav = document.getElementById('mainNav');
  const btn = document.getElementById('navToggle');
  const navbar = document.querySelector('.navbar');
  const prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  if(btn && nav){
    btn.addEventListener('click', function(e){ nav.classList.toggle('active'); e.stopPropagation(); });
    // close when clicking outside
    document.addEventListener('click', function(e){ if(nav.classList.contains('active') && !nav.contains(e.target) && e.target !== btn){ nav.classList.remove('active'); } });
  }

  // sticky blur on scroll
  function onScroll(){ if(window.scrollY > 16) navbar && navbar.classList.add('scrolled'); else navbar && navbar.classList.remove('scrolled'); }
  onScroll(); window.addEventListener('scroll', onScroll, {passive:true});

  // hero parallax (skip if user prefers reduced motion)
  const heroImg = document.querySelector('.hero-visual .car');
  if(heroImg && !prefersReduced){
    let ticking = false;
    function handleParallax(){
      if(ticking) return; ticking = true;
      window.requestAnimationFrame(()=>{
        const rect = heroImg.getBoundingClientRect();
        const windowH = window.innerHeight;
        const centerOffset = rect.top - windowH/2 + rect.height/2;
        const val = Math.max(-20, Math.min(20, -centerOffset * 0.03));
        heroImg.style.transform = `translateY(${val}px)`;
        ticking = false;
      });
    }
    handleParallax(); window.addEventListener('scroll', handleParallax, {passive:true}); window.addEventListener('resize', handleParallax);
  }

  // simple click micro-interaction on CTA
  document.querySelectorAll('.cta').forEach(el=>{
    el.addEventListener('click', e=>{
      el.classList.add('pressed'); setTimeout(()=>el.classList.remove('pressed'),160);
    });
  });

  // keyboard accessibility for product cards
  document.querySelectorAll('.card').forEach(card=>{
    if(!card.hasAttribute('tabindex')) card.setAttribute('tabindex','0');
    // on Enter/Space, focus first interactive element
    card.addEventListener('keydown', function(e){
      if(e.key === 'Enter' || e.key === ' '){ e.preventDefault(); const next = card.querySelector('a, button, input'); if(next) next.focus(); }
    });
    // Add keyboard focus class to style when focus is via keyboard
    card.addEventListener('focusin', ()=>card.classList.add('keyboard-focus'));
    card.addEventListener('focusout', ()=>card.classList.remove('keyboard-focus'));
  });
});
