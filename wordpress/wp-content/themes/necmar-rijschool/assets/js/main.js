(function () {
  var revealNodes = document.querySelectorAll('.pr-reveal');
  if (revealNodes.length && 'IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.18 });

    revealNodes.forEach(function (node) {
      io.observe(node);
    });
  } else {
    revealNodes.forEach(function (node) {
      node.classList.add('is-visible');
    });
  }

  var cards = document.querySelectorAll('.pr-packages-grid .elementor-column > .elementor-widget-wrap, .pr-services .elementor-column > .elementor-widget-wrap');
  cards.forEach(function (card) {
    card.addEventListener('mousemove', function (e) {
      var rect = card.getBoundingClientRect();
      var x = (e.clientX - rect.left) / rect.width;
      var y = (e.clientY - rect.top) / rect.height;
      var rx = (0.5 - y) * 4;
      var ry = (x - 0.5) * 4;
      card.style.transform = 'translateY(-6px) rotateX(' + rx + 'deg) rotateY(' + ry + 'deg)';
    });

    card.addEventListener('mouseleave', function () {
      card.style.transform = '';
    });
  });
})();
