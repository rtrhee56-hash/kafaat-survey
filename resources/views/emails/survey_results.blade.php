<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<style>
  body {
    font-family: 'Arial', sans-serif;
    color: #333;
    line-height: 1.6;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
  }
  .email-container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
  }
  .header {
    background-color: #0056b3; /* Kafaat primary blue */
    color: #fff;
    padding: 20px;
    text-align: center;
  }
  .logo {
    max-width: 150px; /* Adjust as needed */
    height: auto;
  }
  .content {
    padding: 30px;
  }
  h1 {
    color: #0056b3;
    font-size: 24px;
    margin-bottom: 20px;
    border-bottom: 2px solid #0056b3;
    display: inline-block;
    padding-bottom: 5px;
  }
  h2 {
    color: #0056b3;
    font-size: 18px;
    margin-top: 25px;
    margin-bottom: 10px;
  }
  .info-group {
    margin-bottom: 15px;
  }
  .info-group strong {
    color: #0056b3;
    display: inline-block;
    width: 120px; /* Align labels */
  }
  .ratings-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
  }
  .ratings-table th, .ratings-table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: right;
  }
  .ratings-table th {
    background-color: #f2f2f2;
    color: #0056b3;
  }
  .star-rating {
    color: #f39c12; /* Gold star color */
    font-size: 18px;
  }
  .footer {
    background-color: #f2f2f2;
    color: #777;
    padding: 15px;
    text-align: center;
    font-size: 14px;
  }
</style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <img src="https://drive.google.com/uc?export=view&id=1dj3CPWWFiPQ4UGskuobTIgDE4YnzFbCj" alt="شعار كفاءات" style="width: 150px; height: auto;">
      <!-- يمكنك إضافة نص هنا إذا أردت، مثل "جمعية كفاءات الأهلية" -->
    </div>
    <div class="content">
      <h1>تقرير بيانات استبيان جديدة</h1>

      <div class="info-group">
        <strong>الاسم:</strong> <span>{{ $data['name'] }}</span> 
      </div>
      <div class="info-group">
        <strong>الجنس:</strong> <span>{{ $data['gender'] }}</span> 
      </div>

      <h2>التقييمات:</h2>
      <table class="ratings-table">
        <thead>
          <tr>
            <th>السؤال</th>
            <th>التقييم</th>
          </tr>
        </thead>
  <tbody>
  @foreach($data['ratings'] as $question => $score)
    <tr>
      <!-- اسم السؤال -->
      <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">
        {{ $question }}
      </td>
      
  
<td style="padding: 10px; border: 1px solid #ddd; text-align: right;">
    <div class="star-rating" style="color: #f39c12; font-size: 18px; display: inline-block;">
        
        @for ($i = 0; $i < 5; $i++)
            @if ($i < $score) ★ @else ☆ @endif
        @endfor
        
        <span style="color: #f39c12; font-size: 14px; margin-right: 10px; display: inline-block;">
{{ str_replace(['1','2','3','4','5'], ['١','٢','٣','٤','٥'], $score) }} من ٥        </span>
    </div>
</td>
    </tr>
  @endforeach
</tbody>
      </table>


      <!-- ... الجزء الخاص بالجدول (التقييمات) ... -->

<h2>هل توصي بالتدريب:</h2>
<p>{{ $data['recommendation'] }}</p>

<h2>التقييم العام:</h2>
<div class="star-rating" style="color: #f39c12; font-size: 24px;">
    <!-- عرض النجوم بناءً على قيمة $data['overall_rating'] -->
    @for ($i = 0; $i < 5; $i++)
        @if ($i < $data['overall_rating']) ★ @else ☆ @endif
    @endfor
    
    <!-- عرض الرقم بجانب النجوم -->
    <span style="font-size: 16px; margin-right: 10px; color: #333;">
        <!-- استبدلي هذا السطر -->
{{ str_replace(['1','2','3','4','5'], ['١','٢','٣','٤','٥'], $data['overall_rating']) }} من ٥
    </span>
</div>


      
      <h2>الملاحظات:</h2>
      <p>{{ $data['notes'] }}</p> <!-- مثال: يفضل زيادة عدد الأمثلة العملية في الجزء الثاني من الدورة. شكراً لكم! -->
    </div>
    <div class="footer">
      © 2023 جمعية كفاءات الأهلية. شكراً لمشاركتكم!
    </div>
  </div>
</body>
</html>