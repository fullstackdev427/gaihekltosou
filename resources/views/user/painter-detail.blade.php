@extends('layouts.app')

@section('logo')
  <img class="logo-icon" src="/image/logo.png">
@endsection

@section('title')
<painter-search-bar></painter-search-bar>
@endsection

@section('logout')
<a href="{{ route('user.edit') }}" class="btn btn-bulk-quotation" role="button" aria-disabled="true">一括見積</a>
@endsection
@section('title')
<a class="text-white page-title" href="#">評 価</a>
@endsection


@section('content')
<div class="form-container painter-detail">
    <div class="slider">
      <div class="slide_viewer">
        <div class="slide_group">
          <div class="slide">
            <img src="/image/mypageimg.PNG" alt="">
          </div>
          <div class="slide">
            <img src="/image/mypageimg.PNG" alt="">
          </div>
          <div class="slide">
            <img src="/image/mypageimg.PNG" alt="">
          </div>
          <div class="slide">
            <img src="/image/mypageimg.PNG" alt="">
          </div>
          <div class="slide">
            <img src="/image/mypageimg.PNG" alt="">
          </div>
        </div>
      </div>
      <div class="slide_buttons">
      </div>
  </div>
    <div class="address">
      <div class="address-name">
        <h4>愛知県名古屋市</h4>
        <h2>株式会社 七色</h2>
      </div>
      <div class="address-number">
        <h3>施工実績数</h3>
        <h4>7</h4>
        <h4>7</h4>
        <h4>1</h4>
        <h4>6</h4>
      </div>
    </div>
    <div class="consult-txt">
      <h4>東海地区最大9店舗で展開する塗替え道場です。<br>
        お客様の笑顔のために心を込めて施工させていた だきます!
      </h4>
      <div class="btn-body">
        <a href="" class="btn-confirm">相談する</a>
        <div class="btn-img-part">
          <h4 class="btn-img-txt">お気に入り登録</h4>
          <img src="/image/favorite1.png" alt="">
        </div>
      </div>
    </div>
    <div class="profile">
      <div class="contain">
        <div class="profile-title">
          <h2>PROFILE</h2>
        </div>
        <div class="profile-body">
          <p>会社情報が入ります会社情報が入ります会社情報が入ります会 社情報が入ります会社情報が入ります会社情報が入ります会社 情報が入ります会社が入ります会社情報が入ります会社情報が 入ります</p>
        </div>
      </div>
    </div>
    <div class="company">
      <div class="company-title">
        <h2>会社概要</h2>
      </div>
      <div class="company-body">
        <table>
          <tbody>
            <tr>
              <th>名称</th>
              <td>株式会社七色</td>
            </tr>
            <tr>
              <th>代表者</th>
              <td>小林勝庸</td>
            </tr>
            <tr>
              <th>所在地</th>
              <td>愛知県名古屋市港区小碓4 丁目99</td>
            </tr>
            <tr>
              <th>TEL</th>
              <td>0120-168-373</td>
            </tr>
            <tr>
              <th>FAX</th>
              <td>052-304-9314</td>
            </tr>
            <tr>
              <th>従業員数</th>
              <td>82名 ※2021年現在</td>
            </tr>
            <tr>
              <th>設立</th>
              <td>平成18年2月2日</td>
            </tr>
            <tr>
              <th>資本金</th>
              <td>90,000,000円</td>
            </tr>
            <tr>
              <th>建設業許可</th>
              <td>愛知県知事許可（般・29）第104578号</td>
            </tr>
            <tr>
              <th>事業内容</th>
              <td>一般住宅•アパート・マンションの塗替等</td>
            </tr>
            <tr>
              <th>加盟団体</th>
              <td>JIOリフォームかし保険</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="example">
      <div class="example-title">
        <h2>施工事例</h2>
      </div>
      <div class="example-body">
        <div class="example-part">
          <img src="/image/example01.png" alt="">
          <img src="/image/example02.png" alt="">
          <img src="/image/example03.png" alt="">
          <img src="/image/example04.png" alt="">
        </div>
      </div>
      <div class="show-btn">
        <a href="">施工事例を見る</a>
      </div>
    </div>
    <div class="logomi">
      <div class="logomi-contain">
        <img src="/image/logomi.png" alt="">
        <div class="logomi-title">
          <h3>愛知県Yさん</h3>
          <div class="logomi-img">
          <starrating :rating="5">
          </div>
        </div>
        <div class="logomi-body">
          <p>5社の見積もりの中から塗替え道場さんを選ばせていただきました。<br>
            決め手はスタッフさんの人柄と提案内容でした。<br>
            他社は『ウチは安いですよ」という売り方だったのに対して、 塗替え道場さんは「この家には油性塗料での外壁塗装がいいで す」という風に、価格ではなく家の今後を見て提案してくれま した。<bar>
            施工も無事に完了し、これからは長いお付き合いになります が、スタッフさんの人柄も良いので心配していません。<br>
            良い業者さんに出会えてラッキーだったと思っています。</p>
        </div>
        <div class="logomi-title">
          <h3>愛知県Yさん</h3>
          <div class="logomi-img">
          <starrating :rating="5">
          </div>
        </div>
        <div class="logomi-body">
          <p>5社の見積もりの中から塗替え道場さんを選ばせていただきました。<br>
            決め手はスタッフさんの人柄と提案内容でした。<br>
            他社は『ウチは安いですよ」という売り方だったのに対して、 塗替え道場さんは「この家には油性塗料での外壁塗装がいいで す」という風に、価格ではなく家の今後を見て提案してくれま した。<bar>
            施工も無事に完了し、これからは長いお付き合いになります が、スタッフさんの人柄も良いので心配していません。<br>
            良い業者さんに出会えてラッキーだったと思っています。</p>
        </div>
        <div class="logomi-title">
          <h3>愛知県Yさん</h3>
          <div class="logomi-img">
          <starrating :rating="4">
          </div>
        </div>
        <div class="logomi-body">
          <p>5社の見積もりの中から塗替え道場さんを選ばせていただきました。<br>
            決め手はスタッフさんの人柄と提案内容でした。<br>
            他社は『ウチは安いですよ」という売り方だったのに対して、 塗替え道場さんは「この家には油性塗料での外壁塗装がいいで す」という風に、価格ではなく家の今後を見て提案してくれま した。<bar>
            施工も無事に完了し、これからは長いお付き合いになります が、スタッフさんの人柄も良いので心配していません。<br>
            良い業者さんに出会えてラッキーだったと思っています。</p>
        </div>
      </div>
      <div class="show-btn">
        <a href="">口コミを見る</a>
      </div>
    </div>
    <div class="column">
      <div class="column-contain">
        <div class="column-img">
          <img src="/image/column.png" alt="">
        </div>
        <div class="column-date grey">
          <h4>2021.03.03.wed 15:30</h4>
        </div>
        <div class="column-subtitle">
          <h4>カテゴリ 塗装施工内容について</h4>
        </div>
        <div class="column-title">
          <h2>外壁塗装あれこれ</h2>
          <h4 class="grey">#外壁塗装 #屋根塗装 #ベランダ防水 #塗替え道場</h4>
        </div>
        
        <div class="column-body">
          <p>ここにコラム本文が入ります。ここにコラ ム本文が入ります。ここにコラム本文が入 ります。ここにコラム本文が入ります。こ こにコラム本文が入ります。ここにコラム 本文が入ります。ここにコラム本文が入り ます。ここにコラム本文が入ります。ここ にコラム本文が入ります。ここにコラム本 文が入ります。ここにコラム本文が入りま す。ここにコラム本文が入ります。ここに コラム本文が入ります。ここにコラム本文 が入ります。ここにコラム本文が入りま す。ここにコラム本文が入ります。ここに</p>
        </div>
      </div>
      <div class="show-btn">
        <a href="">コラムを見る</a>
      </div>
    </div> 
</div>
@endsection