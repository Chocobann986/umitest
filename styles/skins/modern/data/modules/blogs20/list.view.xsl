<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "ulang://common/" [
	<!ENTITY sys-module          'blogs20'>
	<!ENTITY sys-method-add      'add'>
	<!ENTITY sys-method-edit     'edit'>
	<!ENTITY sys-method-del      'del'>
	<!ENTITY sys-method-list     'posts'>
	<!ENTITY sys-method-activity 'activity'>

	<!ENTITY sys-type-list       'blog'>
	<!ENTITY sys-type-item       'post'>
]>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
	<xsl:template match="data[@type = 'list' and @action = 'view']">
		<div class="location" xmlns:umi="http://www.umi-cms.ru/TR/umi">
			<xsl:choose>
				<xsl:when test="/result/@method='blogs'">
					<div class="imgButtonWrapper">
						<a id="addBlog" class="btn color-blue loc-left" href="{$lang-prefix}/admin/&sys-module;/&sys-method-add;/{$param0}/blog/">&label-add-blog;</a>
						<a id="addPost" class="btn color-blue loc-left" href="{$lang-prefix}/admin/&sys-module;/&sys-method-add;/{$param0}/post/">&label-add-post;</a>
					</div>
				</xsl:when>
				<xsl:when test="/result/@method='posts'">

					<div  class="imgButtonWrapper">
						<a id="postAdd" onclick="fixAddUrl()" class="btn color-blue loc-left"
						   href="{$lang-prefix}/admin/&sys-module;/&sys-method-add;/{$param0}/&sys-type-item;/">&label-add-post-to;</a>
						<xsl:apply-templates select="/result/data/blogs">
							<xsl:with-param name="control_id">blog_id</xsl:with-param>
						</xsl:apply-templates>
					</div>

					<script type="text/javascript">
						function fixAddUrl() {
							var select = document.getElementById('blog_id');
							var id = select.options[select.selectedIndex].value;
							var container = document.getElementById('postAdd');

							if (typeof id == 'string' &amp;&amp; id.length == 0) {
								openDialog('', getLabel('js-error-blog-not-found-title'), {
									html       : getLabel('js-error-blog-not-found-content'),
									width      : 350,
									confirmText: getLabel('js-error-blog-not-confirm'),
									confirmCallback : function () {
										closeDialog();
									}
								});
								event.preventDefault();
							} else {
								$('a', container).addBack().attr('href', "/admin/&sys-module;/&sys-method-add;/" + id + "/post/");
							}
						}
					</script>
				</xsl:when>
				<xsl:otherwise>

				</xsl:otherwise>
			</xsl:choose>
			<xsl:call-template name="entities.help.button" />
		</div>

		<div class="layout">
			<div class="column">
				<xsl:call-template name="ui-smc-table">
					<xsl:with-param name="control-params"><xsl:value-of select="/result/@method"/></xsl:with-param>

					<xsl:with-param name="allow-drag">1</xsl:with-param>
					<xsl:with-param name="js-add-buttons">
						<xsl:if test="/result/@method='blogs'">
							createAddButton(
							$('#addBlog')[0], oTable,
							'<xsl:value-of select="$lang-prefix" />/admin/&sys-module;/&sys-method-add;/{id}/blog/', [true]);
							createAddButton(
							$('#addPost')[0], oTable,
							'<xsl:value-of select="$lang-prefix" />/admin/&sys-module;/&sys-method-add;/{id}/post/', ['blog']);
						</xsl:if>
					</xsl:with-param>

					<xsl:with-param name="ignore-hierarchy-parent-types">
						<xsl:if test="/result/@method='posts' or /result/@method='comments'">1</xsl:if>
					</xsl:with-param>
				</xsl:call-template>

			</div>
			<div class="column">
				<xsl:call-template name="entities.help.content" />
			</div>
		</div>
	</xsl:template>

	<xsl:template match="blogs">
        <xsl:param name="control_id"/>
        <select id="{$control_id}" style="width:250px;" class="default newselect posts">
            <xsl:apply-templates select="blog"/>
        </select>
    </xsl:template>

    <xsl:template match="blog">
        <option value="{@id}">
            <xsl:value-of select="text()"/>
        </option>
    </xsl:template>

</xsl:stylesheet>
