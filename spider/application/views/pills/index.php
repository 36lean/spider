<div class="panel panel-default">
<div class="panel-body">

<div class="container">

	<div class="col-md-4">
		<form action="" method="post">
		<div class="form-group">
			<input class="form-control" name="table_name" type="text" /> 
		</div>

		<div class="form-group">
			<button class="btn btn-primary" name="posts" value="1">设置表名</button>
		</div>
		</form>
	</div>

</div>

</div>
</div>



<div class="panel panel-default">
<div class="panel-body">


<div class="col-md-4">
	
	<form class="form-horizontal" role="form" action="" method="post">
  	
	<div class="form-group">
    	<label>规则名</label>
    	<div class="col-lg-12">
      		<input class="form-control" name="rulename" type="text" placeholder="" value="">
    	</div>
  	</div>

  	<?php foreach ($data as $key => $value) :?>
  	<div class="form-group">
    	<label><?php echo $key;?></label>
    	<div class="col-lg-12">
      		<input class="form-control" name="<?php echo $key;?>" type="text" placeholder="<?php echo $value;?>" value="">
    	</div>
  	</div>
  	<?php endforeach ?>

  	<button class="btn btn-primary" name="set_rule" value="1">采集映射规则</button>

	</form>

</div>


<div class="col-md-4">
	
	<form class="form-horizontal" role="form" action="" method="post">
  	

  	<div class="form-group">
    	<label>来源名</label>
    	<div class="col-lg-12">
      		<input class="form-control" name="source" type="text" placeholder="" value="">
    	</div>
  	</div>

  	<div class="form-group">
    	<label>文章链接匹配标签</label>
    	<div class="col-lg-12">
      		<input class="form-control" name="links" type="text" placeholder="" value="">
    	</div>
  	</div>

    <div class="form-group">
      <label>尾部分割(找通用的html字符串)</label>
      <div class="col-lg-12">
          <input class="form-control" name="split" type="text" placeholder="" value="">
      </div>
    </div>

    <div class="form-group">
      <label>唯一识别字段(例如 title)</label>
      <div class="col-lg-12">
          <input class="form-control" name="unique" type="text" placeholder="" value="">
      </div>
    </div>

  	<div class="form-group">
    	<label>使用规则</label>
    	<div class="col-lg-12">
      		<select name="rule">
      			<?php foreach ($rule as $r) :?>
      				<option value="<?php echo $r;?>"><?php echo $r;?></option>
      			<?php endforeach ?>
      		</select>
    	</div>
  	</div>

    <div class="form-group">
      <label>Links</label>
      <div class="col-lg-12">
          <textarea class="form-control" rows="5" name="link"></textarea>
      </div>
    </div>

  	<button class="btn btn-primary" name="set_source" value="1">设置采集来源</button>

	</form>

	<div class="page-header">
  		<h3>数据采集测试</h3>
	</div>

	<ul class="nav nav-pills nav-stacked">
		<?php foreach ($source as $s) :?>
			<li><a href="<?php echo site_url('pills/view/'.$s);?>"><?php echo $s;?></a></li>
		<?php endforeach ?>
	</ul>

</div>

<div class="col-md-4">

	<form action="" method="post">

		<div class="form-group">
    	<label>选择来源</label>
    	<div class="col-lg-12">
      		<select name="source">
      			<?php foreach ($source as $s) :?>
      				<option value="<?php echo $s;?>"><?php echo $s;?></option>
      			<?php endforeach ?>
      		</select>
    	</div>
  	</div>

		<button class="btn btn-primary" name="get" value="1">采集数据</button>
	</form>

</div>


</div>
</div>