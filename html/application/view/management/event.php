<div class="container">

     <div class="demo-info" style="margin-bottom:10px">
		<div class="demo-tip icon-tip">&nbsp;</div>
		<div>Double clic pour éditer.</div>
	</div>
	
	<table id="dg" title="Evenements" style="width:700px;height:250px"
			toolbar="#toolbar" pagination="true" idField="id"
			rownumbers="true" fitColumns="true" singleSelect="true">
		<thead>
			<tr>
				<th field="titre" width="50" editor="{type:'validatebox',options:{required:true}}">Titre</th>
				<th field="info" width="50" editor="{type:'validatebox',options:{required:true}}">Info</th>
				<th field="lien" width="50" editor="{type:'validatebox',options:{required:false}}">Lien</th>
				<th field="date" width="50" class="easyui-datebox" editor="{type:'validatebox',options:{required:true}}">jour</th>
				<th field="type" width="50" editor="{type:'validatebox',options:{required:true}}">type</th>
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

<script type="text/javascript">
    $(function(){
        $('#dg').edatagrid({
            // TODO_LATER: des urls plus jolies
            url: "<?php echo URL . 'management/getevents/'; ?>",
            saveUrl: "<?php echo URL . 'management/postevent/'; ?>",
            updateUrl: "<?php echo URL . 'management/updateevent/'; ?>",
            destroyUrl: "<?php echo URL . 'management/destroyevent/'; ?>"
        });
    });
</script>
