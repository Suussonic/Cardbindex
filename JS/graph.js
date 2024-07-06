$(document).ready(function () {
  $.ajax({
      url: '../BACK/get_logs.php',
      method: 'GET',
      success: function (data) {
          console.log(data); // Vérifie les données reçues
          var logsData;
          try {
              logsData = JSON.parse(data);
              console.log(logsData); // Vérifie que les données sont bien parsées
          } catch (e) {
              console.error("Parsing error:", e);
              return;
          }
          // Filtrage et comptage des logs par date
          var logCountsByDate = _.countBy(_.filter(logsData, { 'action': 'connexion' }), function(log) {
              return log.date.split(' ')[0]; // Extrait la date sans l'heure
          });

          var modificationCountsByDate = _.countBy(_.filter(logsData, { 'action': 'modification de donnée' }), function(log) {
              return log.date.split(' ')[0]; // Extrait la date sans l'heure
          });

          var chartData = {
              log: {
                  title: 'Logs',
                  dataPoints: _.map(logCountsByDate, function(value, key) {
                      return { date: key, value: value };
                  }),
              },
              modification: {
                  title: 'Modifications',
                  dataPoints: _.map(modificationCountsByDate, function(value, key) {
                      return { date: key, value: value };
                  }),
              }
          };

          var getPreviousPeriodDataPoints = function(dataPoints) {
              return dataPoints.map(point => ({ ...point, value: Math.round(point.value * 0.8) }));
          };

          _.each(chartData, function (e) {
              var prevDataPoints = getPreviousPeriodDataPoints(e.dataPoints);
              e.prevTotalDataPoints = _.reduce(prevDataPoints, function (p, f) { return p + f.value; }, 0);
              e.value = _.reduce(e.dataPoints, function (p, f) { return p + f.value; }, 0);
              e.percentage = (e.value - e.prevTotalDataPoints) / e.prevTotalDataPoints * 100;
              e.status = (e.value > e.prevTotalDataPoints) ? 'up' : 'down';
          });

          var chartDataInitial = chartData.log;

          var createChartSchema = function (dataPoints) {
            return {
                labels: _.map(dataPoints, function (e) {
                    return moment(e.date).format('D. MMM');
                }),
                datasets: [{
                    backgroundColor: '#024A8D', // Nouvelle couleur de fond
                    borderColor: '#0A81FF',     // Nouvelle couleur de bordure
                    pointBackgroundColor: 'transparent',
                    pointBorderColor: 'transparent',
                    pointHoverBackgroundColor: '#0A81FF',
                    pointHoverBorderColor: 'rgba(10, 129, 255, 0.3)',
                    data: _.map(dataPoints, function (e) {
                        return e.value;
                    }),
                }]
            };
        };
        
        var chartConfig = {
            responsive: true,
            animation: {
                duration: 1000
            },
            scales: {
                x: {
                    ticks: {
                        color: '#0A81FF'  // Nouvelle couleur des ticks
                    },
                    grid: {
                        color: '#383B42'  // Nouvelle couleur de la grille
                    }
                },
                y: {
                    ticks: {
                        color: '#0A81FF'  // Nouvelle couleur des ticks
                    },
                    grid: {
                        color: '#383B42'  // Nouvelle couleur de la grille
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false,
                    external: function(context) {
                        var tooltipEl = $('.aws-tooltip'),
                            whichChart = $('[data-btn-chart].aws-active').attr('data-btn-chart'),
                            tooltipModel = context.tooltip,
                            currentData, text;
        
                        if (tooltipModel.opacity === 0) {
                            tooltipEl.css({ opacity: 0 });
                            return;
                        }
        
                        currentData = _.find(chartData[whichChart].dataPoints, function (e) {
                            return moment(e.date).format('D. MMM') === tooltipModel.dataPoints[0].label;
                        });
        
                        tooltipEl.removeClass('above below aws-for-file');
                        tooltipEl.addClass(tooltipModel.yAlign);
        
                        text = accounting.formatNumber(currentData.value);
        
                        tooltipEl.html([
                            '<span>' + moment(currentData.date).format("ddd, MMM DD, YYYY") + '</span>',
                            '<span>' + chartData[whichChart].title + ': <b>' + text + '</b></span>'
                        ].join(''));
        
                        var position = context.chart.canvas.getBoundingClientRect();
        
                        tooltipEl.css({
                            opacity: 1,
                            left: position.left + window.pageXOffset + tooltipModel.caretX - (tooltipEl.outerWidth() / 2) + 'px',
                            top: position.top + window.pageYOffset + tooltipModel.caretY - 45 + 'px'
                        });
                    }
                }
            }
        };
        
          var chartContext = document.getElementById('chartCanvas').getContext('2d');

          var updateBlockInfo = function (whichChartData) {
              var $block1After, $block1Before,
                  $block2After, $block2Before;

              $block1Before = $block1After = $('.aws-details .col-md-6:eq(0) .aws-block-info:eq(0)');
              $block2Before = $block2After = $('.aws-details .col-md-6:eq(1) .aws-block-info:eq(0)');

              $block1After.clone().appendTo($block1After.parent());
              $block2After.clone().appendTo($block2After.parent());

              $block1After = $block1After.next();
              $block2After = $block2After.next();

              $block1After.find('h3 span').html([
                  accounting.formatNumber(whichChartData.value), 
                  whichChartData.title
              ].join(' '));

              $block2After.find('h3 span').html(
                  accounting.formatNumber(whichChartData.percentage, 2)
              );

              if (whichChartData.hasOwnProperty('status'))
                  $block2After.find('h3').attr('data-status', whichChartData.status);

              $block1Before.animate({
                  marginTop: -100
              }, 300, 'easeOutCubic', function () {
                  $block1Before.remove();
              });

              $block2Before.animate({
                  marginTop: -100
              }, 300, 'easeOutCubic', function () {
                  $block2Before.remove();
              });
          };

          var chartLine = new Chart(chartContext, {
              type: 'line',
              data: chartSchema,
              options: chartConfig
          });

          updateBlockInfo(chartDataInitial);

          $('[data-btn-chart]').on('click', function () {
              var $self = $(this), 
                  dataBtnChart = $self.attr('data-btn-chart'),
                  whichChartData = chartData[dataBtnChart],
                  targetDataPoints = whichChartData.dataPoints,
                  newChartSchema = createChartSchema(targetDataPoints);

              if ($self.hasClass('aws-active'))
                  return;

              $self.closest('nav').find('.aws-active').removeClass('aws-active');
              $self.addClass('aws-active');

              chartLine.data.labels = newChartSchema.labels;
              chartLine.data.datasets[0].data = newChartSchema.datasets[0].data;

              chartLine.update();
              updateBlockInfo(whichChartData);
          });
      },
      error: function (xhr, status, error) {
          console.error("AJAX Error:", status, error);
      }
  });
});
