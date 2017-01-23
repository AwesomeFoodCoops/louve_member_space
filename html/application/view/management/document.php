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
				<th field="lien" width="50" editor="{type:'validatebox',options:{required:true}}">Lien</th>
				<th field="icone" width="50" editor="{type:'validatebox',options:{required:true}}">Icone</th>
				<th field="categorie" width="50" editor="{type:'validatebox',options:{required:true}}">Categorie</th>
				<th field="titre" width="50" editor="{type:'validatebox',options:{required:true}}">titre</th>
				<th field="acces" width="50" editor="{type:'validatebox',options:{required:true}}">acces</th>
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
            url: "<?php echo URL . 'management/getdocuments/'; ?>",
            saveUrl: "<?php echo URL . 'management/postdocument/'; ?>",
            updateUrl: "<?php echo URL . 'management/updatedocument/'; ?>",
            destroyUrl: "<?php echo URL . 'management/destroydocument/'; ?>"
        });
    });
</script>
