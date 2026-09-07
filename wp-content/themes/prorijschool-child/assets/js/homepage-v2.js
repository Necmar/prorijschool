/**
 * Elementor 4 Atomic Button fallback for HomepageV2.
 */
(function () {
  'use strict';

  var targets = {
    'Naar de proeflesaanvraag': '/proefles/',
    'Proefles boeken': '/proefles/'
  };

  document.addEventListener('click', function (event) {
    var button = event.target.closest('button');
    if (!button) return;
    var destination = targets[button.textContent.trim()];
    if (!destination) return;
    window.location.assign(destination);
  });
}());
