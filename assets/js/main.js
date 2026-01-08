// small helper JS (navigation toggle + small helpers)
document.addEventListener('DOMContentLoaded', function(){
  const nav = document.getElementById('mainNav');
  const btn = document.getElementById('navToggle');
  if(btn && nav){ btn.addEventListener('click', function(){ nav.classList.toggle('active'); }); }
});
