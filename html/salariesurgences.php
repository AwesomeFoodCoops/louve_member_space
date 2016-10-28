<?php
require("_php/session.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>La louve - mon espace</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootgrid.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900,300' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <style type="text/css">
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('fonts/glyphicons-halflings-regular.eot');
        }
        
    </style>

	<link rel="stylesheet" type="text/css" href="css/easyui.css">
	<link rel="stylesheet" type="text/css" href="css/icon.css">


</head>
<body>
<?php
require("menu.php");
require("_php/base.php");
require("_php/testsalarie.php");
?>

<div class="container">

		
	<h3> Urgence du moment : </h3>
 
	
     <div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double clic pour éditer.</div>
	</div>
	
	<table id="dg" title="Urgences" style="width:700px;height:250px"
			toolbar="#toolbar" pagination="true" idField="id"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="titre" width="50" editor="{type:'validatebox',options:{required:true}}">Titre</th>
				<th field="info" width="50" editor="{type:'validatebox',options:{required:true}}">Message</th>
				<th field="lien" width="50" editor="{type:'validatebox',options:{required:false}}">Lien</th>
				<th field="datefin" width="50" editor="{type:'validatebox',options:{required:true}}">Affiché jusqu'au</th>
			</tr>
		</thead>
	</table>
	<div id="toolbar">
		<a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="javascript:$('#dg').edatagrid('addRow')">New</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="javascript:$('#dg').edatagrid('destroyRow')">Destroy</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-save" plain="true" onclick="javascript:$('#dg').edatagrid('saveRow')">Save</a>
		<a href="#" class="easyui-linkbutton" iconCls="icon-undo" plain="true" onclick="javascript:$('#dg').edatagrid('cancelRow')">Cancel</a>
	</div>

    </div> <!-- /container -->
<?php require("_php/footer.php"); ?>
 
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
	<script type="text/javascript" src="js/jquery.edatagrid.js"></script>
	<script type="text/javascript">
		$(function(){
			$('#dg').edatagrid({
				url: 'admin/urgences/get_urgences.php',
				saveUrl: 'admin/urgences/save_urgence.php',
				updateUrl: 'admin/urgences/update_urgence.php',
				destroyUrl: 'admin/urgences/destroy_urgence.php'
			});
		});
	</script>
</body>
</html>