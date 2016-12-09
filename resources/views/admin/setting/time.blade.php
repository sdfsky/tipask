@extends('admin/public/layout')
@section('title')时间设置@endsection
@section('content')
<section class="content-header">
    <h1>
        时间设置
        <small>默认时区及时间格式设置</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <form role="form" name="addForm" method="POST" action="{{ route('admin.setting.time') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="time_offset">默认时区</label>
                            <select name="time_offset" class="form-control">
                                @foreach($timeOffsets as $timeOffset=>$title )
                                    <option value="{{ $timeOffset }}" @if(Setting()->get('time_offset') == $timeOffset )) selected @endif>{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group @if ($errors->has('time_diff')) has-error @endif">
                            <label for="time_diff">本地时间与服务器的时间差</label>
                            <span class="text-muted">(时间差(分钟)，例如本地 8:00 服务器 8:10，则填写-10)</span>
                            <input type="text" name="time_diff" class="form-control " placeholder="" value="{{ old('time_diff',Setting()->get('time_diff')) }}">
                            @if ($errors->has('time_diff')) <p class="help-block">{{ $errors->first('time_diff') }}</p> @endif
                        </div>

                        <div class="form-group">
                            <label for="date_format">日期格式</label>
                            <select name="date_format" class="form-control">
                                <option value="Y-n-j"  @if(Setting()->get('date_format') == 'Y-n-j') selected @endif  >{{ date("Y-n-j") }}（Y-n-j）</option>
                                <option value="Y/m/d"  @if(Setting()->get('date_format') == 'Y/m/d') selected @endif  >{{ date("Y/m/d") }}（Y/m/d）</option>
                                <option value="m/d/Y"  @if(Setting()->get('date_format') == 'm/d/Y') selected @endif  >{{ date("m/d/Y") }}（m/d/Y）</option>
                                <option value="d/m/Y"  @if(Setting()->get('date_format') == 'd/m/Y') selected @endif  >{{ date("d/m/Y") }}（d/m/Y）</option>
                                <option value="Y.m.d"  @if(Setting()->get('date_format') == 'Y.m.d') selected @endif  >{{ date("Y.m.d") }}（Y.m.d）</option>
                                <option value="m.d.Y"  @if(Setting()->get('date_format') == 'm.d.Y') selected @endif  >{{ date("m.d.Y") }}（m.d.Y）</option>
                                <option value="Y-m-d"  @if(Setting()->get('date_format') == 'Y-m-d') selected @endif  >{{ date("Y-m-d") }}（Y-m-d）</option>
                                <option value="m-d-Y"  @if(Setting()->get('date_format') == 'm-d-Y') selected @endif  >{{ date("m-d-Y") }}（m-d-Y）</option>
                                <option value="d-m-Y"  @if(Setting()->get('date_format') == 'd-m-Y') selected @endif  >{{ date("d-m-Y") }}（m-d-Y）</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="time_format">时间格式</label>
                            <select name="time_format" class="form-control">
                                <option value="H:i"  @if(Setting()->get('time_format') == 'H:i') selected @endif  >{{ date("H:i") }}（H:i）</option>
                                <option value="H:i:s"  @if(Setting()->get('time_format') == 'H:i:s') selected @endif  >{{ date("H:i:s") }}（H:i:s）</option>
                                <option value="g:i a"  @if(Setting()->get('time_format') == 'g:i a') selected @endif  >{{ date("g:i a") }}（g:i a）</option>
                                <option value="g:i A"  @if(Setting()->get('time_format') == 'g:i A') selected @endif  >{{ date("g:i A") }}（g:i A）</option>
                            </select>
                        </div>

                        <div class="form-group @if ($errors->has('time_friendly')) has-error @endif">
                            <label for="time_friendly">人性化时间格式</label>
                            <span class="text-muted">(开启之后，系统中的时间将显示以“n分钟前”、“昨天”、“n天前”等形式显示)</span>
                            <div class="radio">
                                <label><input type="radio" name="time_friendly"  value="1" @if(Setting()->get('time_friendly')==1) checked @endif>是</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input type="radio" name="time_friendly"  value="0" @if(Setting()->get('time_friendly')==0) checked @endif>否</label>
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">保存</button>
                        <button type="reset" class="btn btn-success">重置</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    set_active_menu('global',"{{ route('admin.setting.time') }}");
</script>
@endsection