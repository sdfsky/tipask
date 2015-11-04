@if($errors->all())
<div class="callout callout-warning">
    <h4>数据保存失败！</h4>
    <ol>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ol>
 </div>
 @endif