/**
 * Prorijschool — rekenhulp
 *
 * Werkt op elke Elementor-opbouw, zolang de knoppen data-attributen
 * hebben. Tarieven komen uit wp_localize_script, zodat ze in PHP
 * staan en niet in de opmaak.
 *
 * Benodigde attributen (Elementor > Geavanceerd > Attributen):
 *   op de buitenste container:  data-reken-blok|
 *   op elke keuzeknop:          data-groep|auto  data-waarde|1  aria-pressed|true
 *   op het bedrag:              data-reken|bedrag
 *   op de toelichting:          data-reken|detail
 */
(function () {
  'use strict';

  var wortel = document.querySelector('[data-reken-blok]');
  if (!wortel) return;

  var cfg = window.proRekenhulp || {};
  var tarief = cfg.tarief || { 60: 62, 90: 89, 120: 116 };
  var examen = typeof cfg.examen === 'number' ? cfg.examen : 380;
  var teksten = cfg.teksten || {};

  var stand = { auto: 1, erv: 34, duur: 90 };

  var velden = {
    bedrag: wortel.querySelector('[data-reken="bedrag"]'),
    detail: wortel.querySelector('[data-reken="detail"]')
  };

  function bereken() {
    var lessen = Math.round((stand.erv * stand.auto) / (stand.duur / 60));
    var totaal = lessen * (tarief[stand.duur] || 0) + examen;
    return { lessen: lessen, totaal: totaal };
  }

  function toon() {
    var r = bereken();

    if (velden.bedrag) {
      velden.bedrag.textContent = '€ ' + r.totaal.toLocaleString('nl-NL');
    }
    if (velden.detail) {
      var sjabloon = teksten.detail || 'ongeveer %lessen% lessen van %duur% minuten, inclusief examen';
      velden.detail.textContent = sjabloon
        .replace('%lessen%', r.lessen)
        .replace('%duur%', stand.duur);
    }
  }

  wortel.addEventListener('click', function (e) {
    var knop = e.target.closest('.pro-keuze');
    if (!knop || !wortel.contains(knop)) return;

    var groep = knop.getAttribute('data-groep');
    var waarde = parseFloat(knop.getAttribute('data-waarde'));
    if (!groep || isNaN(waarde)) return;

    wortel.querySelectorAll('.pro-keuze[data-groep="' + groep + '"]')
      .forEach(function (z) { z.setAttribute('aria-pressed', 'false'); });

    knop.setAttribute('aria-pressed', 'true');
    stand[groep] = waarde;
    toon();
  });

  ['auto', 'erv', 'duur'].forEach(function (g) {
    var actief = wortel.querySelector('.pro-keuze[data-groep="' + g + '"][aria-pressed="true"]');
    if (actief) {
      var w = parseFloat(actief.getAttribute('data-waarde'));
      if (!isNaN(w)) stand[g] = w;
    }
  });

  toon();
})();
