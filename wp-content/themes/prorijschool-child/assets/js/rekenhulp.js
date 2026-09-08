/**
 * Prorijschool — rekenhulp
 *
 * Knoppen worden herkend aan hun HTML-id (via _cssid in Elementor),
 * zodat er geen data-attributen nodig zijn — die bewaart de v4-editor
 * niet betrouwbaar.
 *
 *   wrapper      #rekenhulp
 *   keuzeknoppen #keuze-<groep>-<naam>
 *   bedrag       #reken-bedrag
 *   toelichting  #reken-detail
 *   samenvatting #reken-samenvatting  (optioneel)
 *
 * Tarieven komen uit wp_localize_script (proRekenhulp).
 */
(function () {
  'use strict';

  var wortel = document.getElementById('rekenhulp');
  if (!wortel) return;

  var cfg     = window.proRekenhulp || {};
  var tarief  = cfg.tarief || { 60: 62, 90: 89, 120: 116 };
  var examen  = typeof cfg.examen === 'number' ? cfg.examen : 380;

  // id-achtervoegsel -> rekenwaarde en leesbare naam
  var opties = {
    'auto-hand':      { waarde: 1,    naam: 'handgeschakeld' },
    'auto-automaat':  { waarde: 0.94, naam: 'automaat' },
    'erv-geen':       { waarde: 34,   naam: 'zonder ervaring' },
    'erv-beetje':     { waarde: 24,   naam: 'met een beetje ervaring' },
    'erv-veel':       { waarde: 16,   naam: 'met veel ervaring' },
    'duur-60':        { waarde: 60,   naam: 'lessen van 60 minuten' },
    'duur-90':        { waarde: 90,   naam: 'lessen van 90 minuten' },
    'duur-120':       { waarde: 120,  naam: 'lessen van 120 minuten' }
  };

  // Beginstand. Moet overeenkomen met de knoppen die we markeren.
  var begin = { auto: 'auto-hand', erv: 'erv-geen', duur: 'duur-90' };
  var stand = { auto: 1, erv: 34, duur: 90 };
  var gekozen = { auto: 'auto-hand', erv: 'erv-geen', duur: 'duur-90' };

  var bedragEl = document.getElementById('reken-bedrag');
  var detailEl = document.getElementById('reken-detail');
  var vatEl    = document.getElementById('reken-samenvatting');
  var knoppen  = wortel.querySelectorAll('[id^="keuze-"]');

  if (!knoppen.length || !bedragEl) return;

  function sleutel(el) { return el.id.replace(/^keuze-/, ''); }
  function groepVan(el) { return sleutel(el).split('-')[0]; }

  function toon() {
    var lessen = Math.round((stand.erv * stand.auto) / (stand.duur / 60));
    var totaal = lessen * (tarief[stand.duur] || 0) + examen;

    bedragEl.textContent = '\u20ac ' + totaal.toLocaleString('nl-NL');

    if (detailEl) {
      detailEl.textContent = 'ongeveer ' + lessen + ' lessen van ' +
        stand.duur + ' minuten, inclusief examen';
    }

    if (vatEl) {
      // Lesduur staat al in de regel hierboven; die niet herhalen.
      vatEl.textContent = 'Op basis van ' +
        opties[gekozen.auto].naam + ', ' +
        opties[gekozen.erv].naam + '.';
    }
  }

  function markeer(actief) {
    var groep = groepVan(actief);
    knoppen.forEach(function (k) {
      if (groepVan(k) === groep) {
        var aan = k === actief;
        k.classList.toggle('is-actief', aan);
        k.setAttribute('aria-pressed', aan ? 'true' : 'false');
      }
    });
    gekozen[groep] = sleutel(actief);
  }

  knoppen.forEach(function (k) {
    k.setAttribute('aria-pressed', 'false');
    k.addEventListener('click', function (e) {
      e.preventDefault();
      var o = opties[sleutel(k)];
      if (!o) return;
      stand[groepVan(k)] = o.waarde;
      markeer(k);
      toon();
    });
  });

  // Beginstand markeren op de knop die bij de beginwaarde hoort,
  // niet op de eerste knop van de groep. Anders wijst de markering
  // 60 minuten aan terwijl er met 90 wordt gerekend.
  Object.keys(begin).forEach(function (groep) {
    var el = document.getElementById('keuze-' + begin[groep]);
    if (el) markeer(el);
  });

  toon();
})();
