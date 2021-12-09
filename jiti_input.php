<?php
$str = [];

$file = fopen("data/sokai.csv", "r");
flock($file, LOCK_EX);
if ($file) {
  while ($line = fgetcsv($file)) {
    $str[] = $line;
    // print_r($str);
  }
}
//配列から取り出し
$name = [];
$han = [];
$first = [];
$second = [];
$third = [];
$fourth = [];
$kadai1 = [];
$kadai2 = [];
$kadai3 = [];
$kadai4 = [];
$kadai5 = [];
foreach ($str as $row) {
  $name[] = $row[0];
  $han[] = $row[1];
  $first[] = $row[2];
  $second[] = $row[3];
  $third[] = $row[4];
  $fourth[] = $row[5];
  $kadai1[] = $row[6];
  $kadai2[] = $row[7];
  $kadai3[] = $row[8];
  $kadai4[] = $row[9];
  $kadai5[] = $row[10];
}
//課題配列結合
$kadai_total = array_merge($kadai1, $kadai2, $kadai3, $kadai4, $kadai5);

//結果集計
$first_count = array_count_values($first);
$first_count_key = array_keys($first_count);
$first_count_value = array_values($first_count);
// var_dump($fcount_key);
// exit();
$second_count = array_count_values($second);
$second_count_key = array_keys($second_count);
$second_count_value = array_values($second_count);
$third_count = array_count_values($third);
$third_count_key = array_keys($third_count);
$third_count_value = array_values($third_count);
$fourth_count = array_count_values($fourth);
$fourth_count_key = array_keys($fourth_count);
$fourth_count_value = array_values($fourth_count);
$kadai_count = array_count_values($kadai_total);
$kadai_count_key = array_keys($kadai_count);
$kadai_count_value = array_values($kadai_count);

// var_dump($kadai_count);
// exit();
//javascriptに渡す
$jfirst_count_key = json_encode($first_count_key);
$jfirst_count_value = json_encode($first_count_value);
$jsecond_count_key = json_encode($second_count_key);
$jsecond_count_value = json_encode($second_count_value);
$jthird_count_key = json_encode($third_count_key);
$jthird_count_value = json_encode($third_count_value);
$jfourth_count_key = json_encode($fourth_count_key);
$jfourth_count_value = json_encode($fourth_count_value);
$jkadai_count_key = json_encode($kadai_count_key);
$jkadai_count_value = json_encode($kadai_count_value);
flock($file, LOCK_UN);
fclose($file);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/style.css">
  <title>Document</title>
</head>

<body>
  <h1>中塚自治会総会議決</h1>
  <form action="jiti_create.php" method="POST">
    <fieldset>
      <legend>基本項目</legend>
      <div>
        名前：<input type="text" name="name">
      </div>
      <div>
        班 ：<select name="han">
          <option value="１班">１班</option>
          <option value="２班">２班</option>
          <option value="３班">３班</option>
          <option value="４班">４班</option>
          <option value="５班">５班</option>
          <option value="６班">６班</option>
        </select>
      </div>

    </fieldset>
    <fieldset>
      <legend>議決事項</legend>
      <div>
        <p>議案第１号 令和2年度決算（案）</p>
        <input type="radio" name="kessan" value="賛成">賛成
        <input type="radio" name="kessan" value="反対">反対
      </div>
      <div>
        <p>議案第２号 令和3年度事業計画</p>
        <input type="radio" name="keikaku" value="賛成">賛成
        <input type="radio" name="keikaku" value="反対">反対
      </div>
      <div>
        <p>議案第３号 令和3年度予算（案）</p>
        <input type="radio" name="yosan" value="賛成">賛成
        <input type="radio" name="yosan" value="反対">反対
      </div>
      <div>
        <p>議案第４号 令和3年度会長投票</p>
        <input type="radio" name="kaichou" value="田中新治">田中新治
        <input type="radio" name="kaichou" value="小栗旬">小栗旬
        <input type="radio" name="kaichou" value="大泉洋">大泉洋
        <input type="radio" name="kaichou" value="米倉涼子">米倉涼子
      </div>
    </fieldset>
    <fieldset>
      <legend>地域課題の共有</legend>
      <div>
        <p>現在、困りごとはありますか。</p>
        <input type="checkbox" name="komarigoto1" value="移動手段がない">移動手段がない
        <input type="checkbox" name="komarigoto2" value="草刈りができない">草刈りができない
        <input type="checkbox" name="komarigoto3" value="災害時に避難が不安だ">災害時に避難が不安だ
        <input type="checkbox" name="komarigoto4" value="買い物する場所がない">買い物する場所がない
        <input type="checkbox" name="komarigoto5" value="話し相手がいない">話し相手がいない
      </div>
    </fieldset>
    <button>submit</button>
  </form>
  <fieldset>
    <table border="1">
      <tr>
        <th>氏名</th>
        <th>班</th>
        <th>議案第１号</th>
        <th>議案第２号</th>
        <th>議案第３号</th>
        <th>議案第４号</th>
        <th>困りごと</th>
      </tr>
      <?php foreach ($str as $row) { ?>
        <tr>
          <?php foreach ($row as $value) { ?>
            <td><?= $value ?></td>
          <?php } ?>
        </tr>
      <?php } ?>
    </table>
  </fieldset>
  <h2>結果集計</h2>
  <div class="gurph">
    <div>
      <canvas id="myChart"></canvas>
    </div>
    <div>
      <canvas id="myChart1"></canvas>
    </div>
    <div>
      <canvas id="myChart2"></canvas>
    </div>
    <div>
      <canvas id="myChart3"></canvas>
    </div>
    <div>
      <canvas id="myChart4"></canvas>
    </div>
  </div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>

  <script>
    //phpから値を受け取る
    const first_count_key = JSON.parse('<?php echo $jfirst_count_key; ?>');
    const first_count_value = JSON.parse('<?php echo $jfirst_count_value; ?>');
    const second_count_key = JSON.parse('<?php echo $jsecond_count_key; ?>');
    const second_count_value = JSON.parse('<?php echo $jsecond_count_value; ?>');
    const third_count_key = JSON.parse('<?php echo $jthird_count_key; ?>');
    const third_count_value = JSON.parse('<?php echo $jthird_count_value; ?>');
    const fourth_count_key = JSON.parse('<?php echo $jfourth_count_key; ?>');
    const fourth_count_value = JSON.parse('<?php echo $jfourth_count_value; ?>');
    const kadai_count_key = JSON.parse('<?php echo $jkadai_count_key; ?>');
    const kadai_count_value = JSON.parse('<?php echo $jkadai_count_value; ?>');

    // console.log(first_count_value)
    // console.log(second_count_key)
    // console.log(second_count_value)
    // console.log(third_count_key)
    // console.log(third_count_value)
    // console.log(fourth_count_key)
    // console.log(fourth_count_value)
    // console.log(kadai_count_key)
    // console.log(kadai_count_value)

    //議案第１号グラフ
    let ctx = document.getElementById("myChart");
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: first_count_key,
        datasets: [{
          backgroundColor: [
            "#BB5179",
            "#FAFF67",
          ],
          data: first_count_value
        }]
      },
      options: {
        title: {
          display: true,
          text: '議案 第1号'
        }
      }
    });

    //議案第２号グラフ
    let ctx1 = document.getElementById("myChart1");
    var myPieChart1 = new Chart(ctx1, {
      type: 'pie',
      data: {
        labels: second_count_key,
        datasets: [{
          backgroundColor: [
            "#BB5179",
            "#FAFF67",
          ],
          data: second_count_value
        }]
      },
      options: {
        title: {
          display: true,
          text: '議案 第2号'
        }
      }
    });

    //議案第３号グラフ
    let ctx2 = document.getElementById("myChart2");
    var myPieChart2 = new Chart(ctx2, {
      type: 'pie',
      data: {
        labels: third_count_key,
        datasets: [{
          backgroundColor: [
            "#BB5179",
            "#FAFF67",
          ],
          data: third_count_value
        }]
      },
      options: {
        title: {
          display: true,
          text: '議案 第2号'
        }
      }
    });

    //議案第４号グラフ
    let ctx3 = document.getElementById("myChart3");
    var myPieChart3 = new Chart(ctx3, {
      type: 'pie',
      data: {
        labels: fourth_count_key,
        datasets: [{
          backgroundColor: [
            "#BB5179",
            "#FAFF67",
            "#58A27C",
            "#3C00FF",
          ],
          data: fourth_count_value
        }]
      },
      options: {
        title: {
          display: true,
          text: '議案 第2号'
        }
      }
    });

    //課題グラフ
    let ctx4 = document.getElementById("myChart4");
    var myPieChart4 = new Chart(ctx4, {
      type: 'bar',
      data: {
        labels: kadai_count_key,
        datasets: [{
          label: '地域課題',
          data: kadai_count_value,
          backgroundColor: "rgba(219,39,91,0.5)"
        }, ]
      },
      options: {
        title: {
          display: true,
          text: '地域課題'
        },
        scales: {
          yAxes: [{
            ticks: {
              suggestedMax: 100,
              suggestedMin: 0,
              stepSize: 10,
              callback: function(value, index, values) {
                return value + '人'
              }
            }
          }]
        },
      }
    });
  </script>
</body>

</html>