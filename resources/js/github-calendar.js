import GitHubCalendar from "github-calendar";
import $ from 'jquery';

$(function() {
  let currentURL = window.location.href;
  let currentFile = currentURL.substring(currentURL.lastIndexOf('/') + 1) || 'index';
  if (currentFile == 'index') {
    GitHubCalendar(".calendar", "DrCantagalo").then(function() {
      let html = $('.calendar').html();
      const translations = {
        it: {
          'Jan': 'Gen', 'Feb': 'Feb', 'Mar': 'Mar', 'Apr': 'Apr', 'May': 'Mag', 'Jun': 'Giu',
          'Jul': 'Lug', 'Aug': 'Ago', 'Sep': 'Set', 'Oct': 'Ott', 'Nov': 'Nov', 'Dec': 'Dic',
          'Sun': 'Dom', 'Mon': 'Lun', 'Tue': 'Mar', 'Wed': 'Mer', 'Thu': 'Gio', 'Fri': 'Ven', 'Sat': 'Sab',
          'Less':'Meno', "More":'di Più'
        },
        pt: {
          'Jan': 'Jan', 'Feb': 'Fev', 'Mar': 'Mar', 'Apr': 'Abr', 'May': 'Mai', 'Jun': 'Jun',
          'Jul': 'Jul', 'Aug': 'Ago', 'Sep': 'Set', 'Oct': 'Out', 'Nov': 'Nov', 'Dec': 'Dez',
          'Sun': 'Dom', 'Mon': 'Seg', 'Tue': 'Ter', 'Wed': 'Qua', 'Thu': 'Qui', 'Fri': 'Sex', 'Sat': 'Sáb',
          'Less':'Menos', 'More':'Mais'
        }
      };

      const dict = translations[window.lang] || {};

      for (const [en, translated] of Object.entries(dict)) {
        const regex = new RegExp(en + '(?=\\s*<\\/span>)', 'g');
        html = html.replace(regex, translated);
      }

      $('.calendar').html(html);
    });
  }
});
