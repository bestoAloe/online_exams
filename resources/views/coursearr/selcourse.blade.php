<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="/public/css/app.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>选课系统</title>
    <style>
      body {
        background-color: #a6bfc6;
      }
      .toubu{
        width: 70%;
        height: auto;
        margin: auto;
        background-color: #eee;
      }

      .findcoe{
        width: 70%;
        height: auto;
        margin: auto;
      }
      .xiabu{
        width: 70%;
        height: auto;
        margin: auto;
      }

      .bg-color0{
        background-color: #83b3c4 !important;
      }

      .bg-color1{
        background-color: #debcc3 !important;
      }

      .bg-color2{
        background-color: #B5D7EE !important;
        border: 1px solid #B5D7EE;
      }

      .btn-color1 {
        color: #555;
        background-color: #FBC9D3;
        border-color: 1px  solid rgba(240, 240, 240, 0.5);
      }

    </style>
</head>

<body>
<div class="container-fluid ">
  <div class="toubu my-3 rounded">
    <div class="findcoe my-2">
      <form class="offset-sm-2" action="{{route('selcourse')}}" method="POST">
      @csrf
        <div class="row">
          <div class="col">
            <select name="protype_id" class="form-control mt-3">
              <option  selected value="">学院</option>
              @foreach($protype as $prty)
              <option value="{{$prty->id}}">{{$prty->protype_name}}</option>
              @endforeach
            </select>
          </div>
          <div class="col">
            <select name="profession_id" class="form-control mt-3">
              <option selected value="">专业</option>
            </select>
          </div>
          <div class="col">
            <button type="submit" class="btn  btn-color1 offset-sm-1 mt-3">查询</button>
          </div>
        </div>
      </form>
    </div>
    <div class="row row-cols-3 ">
    @if($whatcourse != '')
    @foreach($whatcourse as $val2)
      <div class="col">
        <div class="row my-2">
          <div name="noselcourse" class="col-sm-10 mx-auto d-block">
          <div class="col">
            <div class="row mt-1">
              <div class="col-sm-12 ">
                <div class=""><img class="rounded" src="{{$val2->cover_img}}"></div>
                <div class="font-weight-bold">{{$val2->course_name}}</div>
                <div class="text-secondary">
                  @isset($val2->rea_coursearr->classtime)
                  <div>{{$val2->rea_coursearr->classtime}}</div>
                  @endisset
                  @isset($val2->rea_coursearr->reacourther->username)
                  <div>{{$val2->rea_coursearr->reacourther->username}}</div>
                  @endisset
                  @if($ifsel[$val2->id])
                  <button type="button" class="btn btn-secondary btn-sm" disabled>已选</button>
                  @else
                  <button type="button" class="btn btn-color1 btn-sm" onclick="selcour({{$val2->id}})">选课</button>
                  @endif
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    @endforeach
    @endif
    </div>
  </div>

</div>

<script type="text/javascript" src="/public/js/app.js"></script>

<script type="text/javascript" >

$('select[name=protype_id]').change(function(){
  //获取当前学院id
  var protype_id = $(this).val();
  $.get('./getprotyid',{protype_id:protype_id},function(prof){
    //jquery的循环操作
    let str = '';
    $.each(prof,function(index,el){
      str += "<option value='" + el.id + "'>" + el.profession_name + "</option>";
    });
    
     //console.log(str);
    //首先清除之前的二级下的数据
    $('select[name=profession_id]').find('option:gt(0)').remove();
    //将数据放到对应的option之后
    $('select[name=profession_id]').append(str);

  },'json');

})

//选课
function selcour($id){
  $.ajax({
      url:"{{route('selcourse')}}",
      type:"POST",
      headers: {
      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      },
      data:{
        course_id:$id,
      },
      success:function(result){
          if(result == 1){
             alert('选课成功'); 
             window.location.reload();
          }
      },
      error:function(XmlHttpRequest, textStatus, errorThrown){
          alert('选课失败');
      }
  })
}



</script>

</body>

</html>