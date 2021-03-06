<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "ulang://common" [
	<!ENTITY sys-module	'webforms'>
]>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

	<xsl:template match="data[@type = 'list' and @action = 'view']">
		<xsl:variable name="toolbarmenu">
			<xsl:choose>
				<xsl:when test="$method = 'messages'"><![CDATA[
					toolbarMenu = ['viewButton','delButton'];
				]]></xsl:when>				
				<xsl:otherwise />
			</xsl:choose>
		</xsl:variable>		
		<xsl:variable name="show-toolbar">
			<xsl:choose>
				<xsl:when test="$method = 'messages'">1</xsl:when>
				<xsl:otherwise>1</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>
		<xsl:variable name="control-params">
			<xsl:choose>
				<xsl:when test="$method = 'messages' and $param0">
					<xsl:value-of select="concat($method, '&amp;type_id=', $param0)" />
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="$method" />
				</xsl:otherwise>
			</xsl:choose>
		</xsl:variable>

		<div class="tabs-content module">
		<div class="section selected">
		<div class="location" xmlns:umi="http://www.umi-cms.ru/TR/umi">
			<div class="imgButtonWrapper loc-left">
				<xsl:choose>
					<xsl:when test="$method = 'addresses'">
						<a id="addAddress" class="btn color-blue" href="{$lang-prefix}/admin/&sys-module;/address_add/">&label-address-add;</a>
					</xsl:when>
					<xsl:when test="$method = 'templates'">
						<a id="addTemplates" class="btn color-blue" href="{$lang-prefix}/admin/&sys-module;/template_add/">&label-template-add;</a>
					</xsl:when>
					<xsl:otherwise />
				</xsl:choose>
			</div>
			<xsl:call-template name="entities.help.button" />
		</div>

		<div class="layout">
		<div class="column">

				<xsl:call-template name="ui-smc-table">
					<xsl:with-param name="control-params" select="$control-params" />
					<xsl:with-param name="content-type" select="'objects'" />
					<xsl:with-param name="toobarmenu" select="$toolbarmenu" />
					<xsl:with-param name="show-toolbar" select="$show-toolbar" />
					<xsl:with-param name="control-type-id" select="$param0" />
				</xsl:call-template>

		</div>
			<div class="column">
				<xsl:call-template name="entities.help.content" />
			</div>
		</div>
		</div>
		</div>
	</xsl:template>

	<xsl:template match="udata[@module = 'webforms'][@method = 'getForms']">
		<div class="pull-left" style="width:35%;">
			<form class="filter-container" action="" method="post"
				  onsubmit="location.href = '/admin/webforms/messages/' + this.form_id.value; return false;">
				<div class="layout-row-icon">
					<div class="layout-col-control">
						<select name="form_id" class="default newselect" placeholder="???????????????? ??????????">
							<option value=""></option>
							<xsl:apply-templates select="items/item"/>
						</select>
					</div>
					<div class="layout-col-icon">
						<input type="submit" class="btn color-blue btn-small fcApplyButton" value="??????????????????????"/>
					</div>
				</div>
			</form>
		</div>

	</xsl:template>

	<xsl:template match="udata[@module = 'webforms' and @method = 'getForms']/items/item">
		<option value="{@id}"><xsl:value-of select="." /></option>
	</xsl:template>

	<xsl:template match="udata[@module = 'webforms' and @method = 'getForms']/items/item[@selected]">
		<option value="{@id}" selected="selected"><xsl:value-of select="." /></option>
	</xsl:template>

	<xsl:template match="/result[@method = 'forms']/data[@type = 'list' and @action = 'view']">
		<div class="tabs-content module">
		<div class="section selected">
		<div class="location" xmlns:umi="http://www.umi-cms.ru/TR/umi">
			<div class="imgButtonWrapper loc-left">
				<a id="addForms" class="btn color-blue" href="{$lang-prefix}/admin/&sys-module;/form_add/{basetype/@id}">&label-form-add;</a>
			</div>
			<xsl:call-template name="entities.help.button" />
		</div>

		<div class="layout">
		<div class="column">

				<xsl:variable name="menu">
					<![CDATA[
							var menu = [
								['edit-item', 'ico_edit',     ContextMenu.itemHandlers.editItem],
								['delete', 'ico_del', ContextMenu.itemHandlers.deleteItem]
							]
						]]>
				</xsl:variable>

				<script type="text/javascript">
					var count = 0;
					var forms = [];
					function updatePages(req) {
						if(!forms.length) return;
						var pages = $('page', req);
						var cache = {};
						for(var i=0; i&lt;forms.length; i++) {
							var id = 'wfpage' + forms[i];
							var e  = document.getElementById(id);
							e.innerHTML = "&lt;a href='<xsl:value-of select="$lang-prefix"/>/admin/webforms/placeOnPage/"+forms[i]+"/'&gt;&label-place;&lt;/a&gt;"
							cache[ forms[i] ] = e;
						}
						if(pages)
						for(var i=0; i&lt;pages.length; i++) {
							var page   = pages.get(i);
							var pageId = parseInt(page.getAttribute('id'));
							if(pageId != 0) {
								var formId  = parseInt(page.getAttribute('form'));
								var href    = page.getAttribute('href');
								var e       = cache[formId];
								e.innerHTML = "&lt;a href='"+href+"'&gt;"+href+"&lt;/a&gt;&nbsp;&nbsp;&nbsp;&lt;a href='<xsl:value-of select="$lang-prefix"/>/admin/content/edit/"+pageId+"/'&gt;&label-edit;&lt;/a&gt;";
							}
						}
						count = 0;
						forms = [];
					}
				</script>
				<xsl:call-template name="ui-smc-table">
					<xsl:with-param name="control-params" select="$method" />
					<xsl:with-param name="flat-mode" select="1" />
					<xsl:with-param name="content-type"><xsl:text>types</xsl:text></xsl:with-param>
					<xsl:with-param name="menu" select="$menu" />
					<xsl:with-param name="enable-edit" >false</xsl:with-param>
					<xsl:with-param name="js-dataset-events">
						<![CDATA[
							oDataSet.addEventHandler('onBeforeLoad', function(p) { forms = []; });
							oDataSet.addEventHandler('onAfterLoad', function(p){ count = p.objects.length; });
						]]>
					</xsl:with-param>
					<xsl:with-param name="toolbarmenu">
						<![CDATA[
									toolbarMenu = ['editButton','delButton'];
								]]>
					</xsl:with-param>
					<xsl:with-param name="js-value-callback">
						<![CDATA[
							function (value, name, item) {
								var data = item.getData();
								if(name === "page") {
									forms.push(data.id);
									if(count == forms.length) {
										$.get(window.pre_lang + "/admin/webforms/getPages.xml?id[]="+forms.join('&id[]='), {}, updatePages);
									}
									return "<span id='wfpage"+data.id+"'>"+getLabel('js-label-wait')+"</span>";
								} else {
									return data.title;
								}
							}
						]]>
					</xsl:with-param>
				</xsl:call-template>

		</div>
			<div class="column">
				<xsl:call-template name="entities.help.content" />
			</div>
		</div>
		</div>
		</div>
	</xsl:template>

</xsl:stylesheet>