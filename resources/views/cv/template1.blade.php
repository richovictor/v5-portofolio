<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 40px;
      background: #f5f2ef;
    }

    .resume {
      max-width: 800px;
      background: white;
      margin: auto;
      padding: 40px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .header {
      display: flex;
      align-items: center;
      border-bottom: 1px solid #ccc;
      padding-bottom: 20px;
    }

    .header img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-right: 20px;
    }

    .header-text h1 {
      margin: 0;
      font-size: 24px;
      color: #4b3b17;
    }

    .header-text h2 {
      font-size: 14px;
      margin: 5px 0;
      font-weight: normal;
      color: #333;
    }

    .section {
      margin-top: 30px;
      display: flex;
      gap: 40px;
    }

    .left, .right {
      flex: 1;
    }

    .section-title {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 10px;
      color: #4b3b17;
    }

    .item {
      margin-bottom: 20px;
    }

    .item .title {
      font-weight: bold;
      margin: 0;
    }

    .item small {
      display: block;
      color: #666;
      margin-bottom: 5px;
    }

    ul {
      padding-left: 20px;
      margin: 0;
    }

    ul li {
      margin-bottom: 5px;
    }
  </style>
</head>
<body>

<div class="resume">
  <div class="header">
    <img src="{{ $user->profile->profile_image ?? 'https://via.placeholder.com/100' }}" alt="Profile Photo">
    <div class="header-text">
      <h1>{{ $user->name }}</h1>
      <h2>{{ $profil->headline ?? 'Fixed Income Portfolio Manager' }}</h2>
      <p>Seeking a Fixed Income Portfolio Manager position in a company where my skills and knowledge can be used and enhanced to the fullest.</p>
    </div>
  </div>

  <div class="section">
    <div class="left">
      <div class="section-title">CONTACT</div>
      <div class="item">
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> (817) 123-3975</p>
        <p><strong>Address:</strong> 1295 Oliver Street<br>Irksa, TX 79504</p>
      </div>

      <div class="section-title">EDUCATION</div>
      <div class="item">
        <p class="title">Bachelor's Degree in Economics, 2012</p>
        <small>Roosevelt University, Chicago, IL</small>
      </div>

      <div class="section-title">SKILLS</div>
      <ul>
        @foreach(explode(',', $skills->skills ?? '') as $skill)
          <li>{{ $skill }}</li>
        @endforeach
      </ul>
    </div>

    <div class="right">
      <div class="section-title">WORK EXPERIENCE</div>
      @foreach($experiences as $exp)
        <div class="item">
          <p class="title">{{ $exp->position }} ({{ $exp->start_date }} - {{ $exp->end_date }})</p>
          <small>{{ $exp->agency }}</small>
          <p>{{ $exp->description }}</p>
        </div>
      @endforeach
    </div>
  </div>
</div>

</body>
</html>
