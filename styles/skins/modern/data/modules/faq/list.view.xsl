<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE xsl:stylesheet SYSTEM "ulang://common/" [
	<!ENTITY sys-module        'faq'>
	<!ENTITY sys-method-add        'add'>
	<!ENTITY sys-method-edit    'edit'>
	<!ENTITY sys-method-del        'del'>
	<!ENTITY sys-method-acivity    'activity'>

	<!ENTITY sys-method-list-projects    'projects_list'>
	<!ENTITY sys-method-list-categories    'categories_list'>
	<!ENTITY sys-method-list-questions    'questions_list'>

	<!ENTITY sys-type-project    'project'>
	<!ENTITY sys-type-category    'category'>
	<!ENTITY sys-type-question    'question'>
]>


<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/result[@method = 'projects_list']/data">
		<div class="tabs-content module">
			<div class="section selected">
				<div class="location" xmlns:umi="http://www.umi-cms.ru/TR/umi">
					<div class="imgButtonWrapper" xmlns:umi="http://www.umi-cms.ru/TR/umi">
						<a id="addProject" href="{$lang-prefix}/admin/&sys-module;/&sys-method-add;/{$param0}/&sys-type-project;/" class="btn color-blue loc-left" umi:type="faq::project">
							<xsl:text>&label-add-project;</xsl:text>
						</a>

						<a id="addCategory" href="{$lang-prefix}/admin/&sys-module;/&sys-method-add;/{$param0}/&sys-type-category;/" class="btn color-blue loc-left" umi:type="faq::category">
							<xsl:text>&label-add-faq-category;</xsl:text>
						</a>

						<a id="addQuestion" href="{$lang-prefix}/admin/&sys-module;/&sys-method-add;/{$param0}/&sys-type-question;/" class="btn color-blue loc-left" umi:type="faq::question">
							<xsl:text>&label-add-question;</xsl:text>
						</a>
					</div>
					<xsl:call-template name="entities.help.button" />
				</div>

				<div class="layout">
					<div class="column">
						<xsl:call-template name="ui-smc-table">
							<xsl:with-param name="js-add-buttons">
								createAddButton(
								$('#addProject')[0], oTable,
								'<xsl:value-of select="$lang-prefix" />/admin/&sys-module;/&sys-method-add;/{id}/&sys-type-project;/',
								[true]
								);
								createAddButton(
								$('#addCategory')[0], oTable,
								'<xsl:value-of select="$lang-prefix" />/admin/&sys-module;/&sys-method-add;/{id}/&sys-type-category;/',
								['project']
								);
								createAddButton(
								$('#addQuestion')[0], oTable,
								'<xsl:value-of select="$lang-prefix" />/admin/&sys-module;/&sys-method-add;/{id}/&sys-type-question;/',
								['category']
								);
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