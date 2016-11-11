<div class="container">

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
				<th field="date" width="50" editor="{type:'validatebox',options:{required:true}}">Affiché dès le</th>
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

<script type="text/javascript">
    $(function(){
        $('#dg').edatagrid({
            // TODO_LATER: des urls plus jolies
            url: "<?php echo URL . 'management/getemergencies/'; ?>",
            saveUrl: "<?php echo URL . 'management/postemergencies/'; ?>",
            updateUrl: "<?php echo URL . 'management/updateemergencies/'; ?>",
            destroyUrl: "<?php echo URL . 'management/destroyemergencies/'; ?>"
        });
    });
</script>
