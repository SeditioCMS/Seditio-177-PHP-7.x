<!-- BEGIN: MAIN -->

		<div class="section">
			<div class="container">
				<div class="row">



<div id="title">

  <h2>{PAGEEDIT_PAGETITLE}</h2>
  
</div>

<div id="subtitle">

	{PAGEEDIT_SUBTITLE}
	
</div>

<div id="page">

<!-- BEGIN: PAGEEDIT_ERROR -->

<div class="error">

	{PAGEEDIT_ERROR_BODY}

</div>

<!-- END: PAGEEDIT_ERROR -->

<form action="{PAGEEDIT_FORM_SEND}" method="post" name="update" enctype="multipart/form-data">

<div class="sedtabs">
	
	<ul class="tabs">
		<li><a href="{PHP.sys.request_uri}#tab1" class="selected">{PHP.L.Page}</a></li>
		<li><a href="{PHP.sys.request_uri}#tab2">{PHP.L.Meta}</a></li>
		<li><a href="{PHP.sys.request_uri}#tab3">{PHP.L.Options}</a></li>
	</ul>
    
    <div class="tab-box">
    
		<div id="tab1" class="tabs">

			<table class="cells striped" class="simple tableforms">
			
				<tr>
					<td style="width:200px;">{PHP.skinlang.pageedit.Category}</td>
					<td>{PAGEEDIT_FORM_CAT}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Title}</td>
					<td>{PAGEEDIT_FORM_TITLE} {PAGEEDIT_FORM_DATENOW}</td>
				</tr>       
			
				<tr>
					<td>{PHP.skinlang.pageedit.Description}</td>
					<td>{PAGEEDIT_FORM_DESC}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Author}</td>
					<td>{PAGEEDIT_FORM_AUTHOR}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Alias}</td>
					<td>{PAGEEDIT_FORM_ALIAS}</td>
				</tr>
						
			<tr>
					<td>{PHP.L.pageimage}</td>
					<td>{PAGEEDIT_FORM_THUMB}</td>
				</tr>						
			
				<!-- BEGIN: PAGEEDIT_PARSING -->

				<tr>
					<td>{PHP.skinlang.pageedit.Parsing}</td>
					<td>{PAGEEDIT_FORM_TYPE}</td>
				</tr>   

				<!-- END: PAGEEDIT_PARSING -->
			
				<tr>
					<td colspan="2">{PHP.skinlang.pageedit.Bodyofthepage}<br /><br />{PAGEEDIT_FORM_TEXT}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Pageid}</td>
					<td>#{PAGEEDIT_FORM_ID}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Deletethispage}</td>
					<td>{PAGEEDIT_FORM_DELETE}</td>
				</tr>
			
			</table>
			
			</div>
			
			<div id="tab2" class="tabs">
			
			<table class="cells striped" class="simple tableforms">

				<tr>
					<td style="width:200px;">{PHP.L.mt_title}</td>
					<td>{PAGEEDIT_FORM_SEOTITLE}</td>
				</tr>
				
				<tr>
					<td>{PHP.L.mt_description}</td>
					<td>{PAGEEDIT_FORM_SEODESC}</td>
				</tr>
				
				<tr>
					<td>{PHP.L.mt_keywords}</td>
					<td>{PAGEEDIT_FORM_SEOKEYWORDS}</td>
				</tr>	
			
			</table>
			
			</div>
			
			<div id="tab3" class="tabs">
			
			<table class="cells striped" class="simple tableforms">

				<tr>
					<td style="width:200px;">{PHP.skinlang.pageedit.Date}</td>
					<td>{PAGEEDIT_FORM_DATE} </td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Begin}</td>
					<td>{PAGEEDIT_FORM_BEGIN}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Expire}</td>
					<td>{PAGEEDIT_FORM_EXPIRE}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Pagehitcount}</td>
					<td>{PAGEEDIT_FORM_PAGECOUNT}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Extrakey}</td>
					<td>{PAGEEDIT_FORM_KEY}</td>
				</tr>	
							
				<tr>
					<td>{PHP.skinlang.pageedit.Owner}</td>
					<td>{PAGEEDIT_FORM_OWNERID}</td>
				</tr>
				
				<tr>
					<td>{PHP.skinlang.pageedit.Allowcomments}</td>
					<td>{PAGEEDIT_FORM_ALLOWCOMMENTS}</td>
				</tr>	
			
				<tr>
					<td>{PHP.skinlang.pageedit.Allowratings}</td>
					<td>{PAGEEDIT_FORM_ALLOWRATINGS}</td>
				</tr>	
			
				<tr>
					<td>{PHP.skinlang.pageedit.Filedownload}</td>
					<td>{PAGEEDIT_FORM_FILE}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.URL}<br />
					{PHP.skinlang.pageedit.URLhint}</td>
					<td>{PAGEEDIT_FORM_URL}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Filesize}<br />
					{PHP.skinlang.pageedit.Filesizehint}</td>
					<td>{PAGEEDIT_FORM_SIZE}</td>
				</tr>
			
				<tr>
					<td>{PHP.skinlang.pageedit.Filehitcount}<br />
					{PHP.skinlang.pageedit.Filehitcounthint}</td>
					<td>{PAGEEDIT_FORM_FILECOUNT}</td>
				</tr>										
			
			</table>			
			
			</div>
			
			<div class="help">{PHP.skinlang.pageedit.Formhint} </div>
		
			<div class="centered">
					<input type="submit" class="submit btn btn-big" value="{PHP.skinlang.pageedit.Update}">
					<!-- BEGIN: PAGEEDIT_PUBLISH -->
					<input type="submit" class="submit btn btn-big" name="rpagepublish" value="{PAGEEDIT_FORM_PUBLISH_TITLE}" onclick="this.value='{PAGEEDIT_FORM_PUBLISH_STATE}'; return true" />
					<!-- END: PAGEEDIT_PUBLISH -->
			</div>			
			
			</div>
</div>
			
</form>

</div>


</div>
</div>
</div>
		
<!-- END: MAIN -->
