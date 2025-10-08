<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm5639="urn:un:unece:uncefact:codelist:specification:5639:1988" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:link="http://www.xbrl.org/2003/linkbase" xmlns:n1="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xbrldi="http://xbrl.org/2006/xbrldi" xmlns:xbrli="http://www.xbrl.org/2003/instance" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:lcl="http://www.efatura.gov.tr/local" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" exclude-result-prefixes="cac cbc ccts clm54217 clm5639 clm66411 clmIANAMIMEMediaType fn link n1 qdt udt xbrldi xbrli xdt xlink xs xsd xsi lcl">
	<xsl:character-map name="a">
		<xsl:output-character character="&#38;" string="&amp;"/>
		<xsl:output-character character="&#34;" string="&quot;"/>
		<xsl:output-character character="&#60;" string="&lt;"/>
		<xsl:output-character character="&#62;" string="&gt;"/>
		<xsl:output-character character="&#39;" string="&apos;"/>
		<xsl:output-character character="&#128;" string=""/>
		<xsl:output-character character="&#129;" string=""/>
		<xsl:output-character character="&#130;" string=""/>
		<xsl:output-character character="&#131;" string=""/>
		<xsl:output-character character="&#132;" string=""/>
		<xsl:output-character character="&#133;" string=""/>
		<xsl:output-character character="&#134;" string=""/>
		<xsl:output-character character="&#135;" string=""/>
		<xsl:output-character character="&#136;" string=""/>
		<xsl:output-character character="&#137;" string=""/>
		<xsl:output-character character="&#138;" string=""/>
		<xsl:output-character character="&#139;" string=""/>
		<xsl:output-character character="&#140;" string=""/>
		<xsl:output-character character="&#141;" string=""/>
		<xsl:output-character character="&#142;" string=""/>
		<xsl:output-character character="&#143;" string=""/>
		<xsl:output-character character="&#144;" string=""/>
		<xsl:output-character character="&#145;" string=""/>
		<xsl:output-character character="&#146;" string=""/>
		<xsl:output-character character="&#147;" string=""/>
		<xsl:output-character character="&#148;" string=""/>
		<xsl:output-character character="&#149;" string=""/>
		<xsl:output-character character="&#150;" string=""/>
		<xsl:output-character character="&#151;" string=""/>
		<xsl:output-character character="&#152;" string=""/>
		<xsl:output-character character="&#153;" string=""/>
		<xsl:output-character character="&#154;" string=""/>
		<xsl:output-character character="&#155;" string=""/>
		<xsl:output-character character="&#156;" string=""/>
		<xsl:output-character character="&#157;" string=""/>
		<xsl:output-character character="&#158;" string=""/>
		<xsl:output-character character="&#159;" string=""/>
	</xsl:character-map>
	<xsl:decimal-format name="european" decimal-separator="," grouping-separator="." NaN=""/>
	<xsl:output version="4.0" method="html" indent="yes" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd" use-character-maps="a"/>
	<xsl:param name="SV_OutputFormat" select="'HTML'"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:variable name="iskontoCount" select="count(n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge)"/>
	<xsl:variable name="irsaliyeCount" select="count(n1:Invoice/cac:DespatchDocumentReference)"/>
	<xsl:variable name="iadeCount" select="count(n1:Invoice/cac:BillingReference)"/>
	<xsl:variable name="earchiveCheckCount" select="count(n1:Invoice/cac:AdditionalDocumentReference[cbc:DocumentTypeCode = 'SendingType'])"/>
	<xsl:template match="/">
		<html>
			<head>
				<title/>
				<style type="text/css">
					body {
					background-color: #FFFFFF;
					font-family: 'Tahoma', "Times New Roman", Times, serif;
					font-size: 11px;
					color: #666666;
					}
					h1, h2 {
					padding-bottom: 3px;
					padding-top: 3px;
					margin-bottom: 5px;
					text-transform: uppercase;
					font-family: Arial, Helvetica, sans-serif;
					}
					h1 {
					font-size: 1.4em;
					text-transform:none;
					}
					h2 {
					font-size: 1em;
					color: brown;
					}
					h3 {
					font-size: 1em;
					color: #333333;
					text-align: justify;
					margin: 0;
					padding: 0;
					}
					h4 {
					font-size: 1.1em;
					font-style: bold;
					font-family: Arial, Helvetica, sans-serif;
					color: #000000;
					margin: 0;
					padding: 0;
					}
					hr {
					height:2px;
					color: #000000;
					background-color: #000000;
					border-bottom: 1px solid #000000;
					}
					p, ul, ol {
					margin-top: 1.5em;
					}
					ul, ol {
					margin-left: 3em;
					}
					blockquote {
					margin-left: 3em;
					margin-right: 3em;
					font-style: italic;
					}
					a {
					text-decoration: none;
					color: #70A300;
					}
					a:hover {
					border: none;
					color: #70A300;
					}
					#despatchTable {
					border-collapse:collapse;
					font-size:11px;
					float:right;
					border-color:black;
					}
					#ettnTable {
					border-collapse:collapse;
					font-size:11px;
					border-color:gray;
					}
					#customerPartyTable {
					border-width: 0px;
					border-spacing:;
					border-style: inset;
					border-color: gray;
					border-collapse: collapse;
					background-color:
					}
					#customerIDTable {
					border-width: 2px;
					border-spacing:;
					border-style: inset;
					border-color: gray;
					border-collapse: collapse;
					background-color:
					}
					#customerIDTableTd {
					border-width: 2px;
					border-spacing:;
					border-style: inset;
					border-color: gray;
					border-collapse: collapse;
					background-color:
					}
					#lineTable {
					border-width:2px;
					border-spacing:;
					border-style: inset;
					border-color: black;
					border-collapse: collapse;
					background-color:;
					}
					#lineTableTd {
					border-width: 1px;
					padding: 1px;
					border-style: inset;
					border-color: black;
					background-color: white;
					}
					#lineTableTr {
					border-width: 1px;
					padding: 0px;
					border-style: inset;
					border-color: black;
					background-color: white;
					-moz-border-radius:;
					}
					#lineTableDummyTd {
					border-width: 1px;
					border-color:white;
					padding: 1px;
					border-style: inset;
					border-color: black;
					background-color: white;
					}
					#lineTableBudgetTd {
					border-width: 2px;
					border-spacing:0px;
					padding: 1px;
					border-style: inset;
					border-color: black;
					background-color: white;
					-moz-border-radius:;
					}
					#notesTable {
					border-width: 2px;
					border-spacing:;
					border-style: inset;
					border-color: black;
					border-collapse: collapse;
					background-color:
					}
					#notesTableTd {
					border-width: 0px;
					border-spacing:;
					border-style: inset;
					border-color: black;
					border-collapse: collapse;
					background-color:
					}
					table {
					border-spacing:0px;
					}
					#budgetContainerTable {
					border-width: 0px;
					border-spacing: 0px;
					border-style: inset;
					border-color: black;
					border-collapse: collapse;
					background-color:;
					}
					#budgetContainerTable2 {
					border-width: 0px;
					border-spacing: 0px;
					border-style: inset;
					border-color: black;
					border-collapse: collapse;
					background-color:;
					}
					td {
					border-color:gray;
					}</style>
				<title>E-Arşiv Fatura</title>
			</head>
			<body style="margin-left=0.6in; margin-right=0.6in; margin-top=0.79in; margin-bottom=0.79in">
				<xsl:for-each select="$XML">
					<table border="0" cellspacing="0px" width="800" cellpadding="0px">
						<tr width="900" height="180" border="0">
							<td>
								<table align="center" border="0" width="100%">
									<tbody>
										<hr/>
										<tr align="left">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:AccountingSupplierParty">
													<xsl:for-each select="cac:Party">
														<td align="left">
															<xsl:if test="cac:PartyName">
																<xsl:value-of select="cac:PartyName/cbc:Name"/>
																<br/>
															</xsl:if>
															<xsl:for-each select="cac:Person">
																<xsl:for-each select="cbc:Title">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:FirstName">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:MiddleName">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:FamilyName">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:NameSuffix">
																	<xsl:apply-templates/>
																</xsl:for-each>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</tr>
										<tr align="left">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:AccountingSupplierParty">
													<xsl:for-each select="cac:Party">
														<td align="left">
															<xsl:for-each select="cac:PostalAddress">
																<xsl:for-each select="cbc:StreetName">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:StreetName!=''">
																		<xsl:apply-templates/>
																		<span>
																			<xsl:text>&#160;</xsl:text>
																		</span>
																	</xsl:if>
																</xsl:for-each>
																<xsl:for-each select="cbc:BuildingName">
																	<xsl:apply-templates/>
																</xsl:for-each>
																<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:BuildingNumber!=''">
																	<span>
																		<xsl:text>No:</xsl:text>
																	</span>
																	<xsl:for-each select="cbc:BuildingNumber">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:if>
																<br/>
																<xsl:for-each select="cbc:PostalZone">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:CitySubdivisionName">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:CitySubdivisionName!=''">
																		<xsl:apply-templates/>
																	</xsl:if>
																</xsl:for-each>
																<span>
																	<xsl:text>/ </xsl:text>
																</span>
																<xsl:for-each select="cbc:CityName">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:CityName!=''">
																		<xsl:apply-templates/>
																		<span>
																			<xsl:text>&#160;</xsl:text>
																		</span>
																	</xsl:if>
																</xsl:for-each>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</tr>
										<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telephone or //n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telefax">
											<tr align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cac:AccountingSupplierParty">
														<xsl:for-each select="cac:Party">
															<td align="left">
																<xsl:for-each select="cac:Contact">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telephone!=''">
																		<span>
																			<xsl:text>Tel: </xsl:text>
																		</span>
																		<xsl:for-each select="cbc:Telephone">
																			<xsl:apply-templates/>
																		</xsl:for-each>
																	</xsl:if>
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telefax!=''">
																		<span>
																			<xsl:text> Fax: </xsl:text>
																		</span>
																		<xsl:for-each select="cbc:Telefax">
																			<xsl:apply-templates/>
																		</xsl:for-each>
																	</xsl:if>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
															</td>
														</xsl:for-each>
													</xsl:for-each>
												</xsl:for-each>
											</tr>
										</xsl:if>
										<xsl:for-each select="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cbc:WebsiteURI">
											<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cbc:WebsiteURI!=''">
												<tr align="left">
													<td>
														<xsl:text>Web Sitesi: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:if>
										</xsl:for-each>
										<xsl:for-each select="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:ElectronicMail">
											<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:ElectronicMail!=''">
												<tr align="left">
													<td>
														<xsl:text>E-Posta: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:if>
										</xsl:for-each>
										<tr align="left">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:AccountingSupplierParty">
													<xsl:for-each select="cac:Party">
														<td align="left">
															<span>
																<xsl:text>Vergi Dairesi: </xsl:text>
															</span>
															<xsl:for-each select="cac:PartyTaxScheme">
																<xsl:for-each select="cac:TaxScheme">
																	<xsl:for-each select="cbc:Name">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																</xsl:for-each>
																<span>
																	<xsl:text>&#160; </xsl:text>
																</span>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</tr>
										<xsl:for-each select="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PartyIdentification">
											<tr align="left">
												<td>
													<xsl:value-of select="cbc:ID/@schemeID"/>
													<xsl:text>: </xsl:text>
													<xsl:value-of select="cbc:ID"/>
												</td>
											</tr>
										</xsl:for-each>
									</tbody>
								</table>
								<hr/>
							</td>
							<td width="25%" align="center" valign="middle">
								<img style="width:91px;" align="middle" alt="Gib Logo" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCABmAGkDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD9U6KKSgBa53xl8QfDvw/sBd6/q1tpsbHEaSv+8lb+6iD5nPsoJrhPFXxYv/EXiRvCHgJ7NtS80213r18w+yWMm0s0ca5BuJwoLeWpwACWIryv+3tG8PRvqPhqz1TxR40mkWUeKtWtVupr21WXyrqWxQFtohfaHjVFKqS2x8c9tPDOXx/d/n2/PyMZVOx6+nxI8W+LNPnuvDPhI6TZJyuoeL5GsVZRyXWBVaTGOfnCVyUmseMNW8WQeHb34s6bpOq3BVYrfQ/DZeJmaIzLGLiYvGZDEpcLkMVG7biuh1Twhrfxo+D+mNfXU3hjxabaVVuvszxJl1eGTfbswYxSxkt5b4ZdynCuuB0Nn8GPD1n4yt/FEQuIdVjihjl8iTy452iiMSM4A3HCHG3dtOFyCVBFKVOmmnvr0vqvN3/CwWbPm74neOvFvw78U+LNJbx34m1C60zT47nTxH9ij+33BMAeLabchAouY2zk/KHOMLmu/s/EHjnTtW0rSbf4pW8+rX9qlzFa+I/DJFvITCZmjS5h8pWYIrMepAUnHBA9W8TfBfwf4u1n+1tU0kXGob5JDN5zglntjbMcZwP3Rxx3AbqM1i6r+zv4avLnUbvT577R7+8tri3FxbyBjE01sts0i7wTuEaLjnAI6cnO31ijKKTVnbXRbk+zkmzkfB/7QnjCTSLLUdd8A3Gr6ZdWUOoLqPhNmuSsEwYxu1vIqychScIXOMccivVvAvxQ8LfEq1ebw9rFvfvEcT2obZcW7f3ZImw6H2YCvJLzRvEfg3xxZ6N4SEl3rWoahPe3UkkE8en2VitoLa0Er8LIsahG8pTl5FONo3MtPRbfRPj74humk0O88Ma/YxNJp3jDTJGgvpAjiMtKBGEAcncIS0oIyGCspUROlCS5krLy/Vf5fcEZSWh9JUV4h4X+MWqeCPESeEfiLPZ3D/aRY2fizTyBa3MxUMsNzGCfss5VlIVjtbcNp7V7d1FcM6cqb1NoyUhaKKKzKErzL4iaxqfirUZfCHh+9OlRJH5uua6rAHT7cjOyMnjznAOCfurlj2rqvH3ixfBvhe61BU8+8O2Czt+89w52xRj6sRXgPjSPXfC99oWgTXF54Xub24kXUPEuqItzoOq+fH+8iniVuHaYpEgcxMFyVc/cbsw9PmfN93+fnYynLoNvdYtry40bwx4FK6h4MnWawsrfwy2Ly2v1EUq3lzO6/uSCZDzkOu4nzDIqD3XwJ8P7fwnZNLdC3u9YuZ2vru4hiKQ/anRVmkhjJbyRIVLMFOCzsf4jWd8K/hbH4ES91G9eO68Q6kS91MixlYFLvJ9nidYkZoleSQr5mWw2CeBj0CitVT9yG35jjHqxGYKCTwK+RP2nf2jpPMuPDHhi9e2WFsXeowSFG3DB2Iw5GO5r0T9qb4yHwD4cGi6bNt1nUUI3KeYYuhb6noK/OTxd4iaZ3t4nJGfmbPJNfKZjjfZ/uob9T9s4F4UWOksxxkbwXwp7Pzfl2OkvPjB4nWZseNdbwD21GX/4qsK++O3jBp0trPxb4guLiQ7UVdQmJJPbG6vONRvH3LDCGknkO1UUZJJ7V9j/ALK/7L8Wj248T+J4l+2hPNPm/dtkHP54rxsNGviZWUml6n6lxBiso4foc0qEJTfwrljq/uOk/Zl8B+OdQ1Sz1zxd4t8RSYIki05dRlMfI/5aAtz9K+uvEHhy+fwlr6eEWsdA8S6hCzR6i1qpBnI4kkwPmPX5jnHXDdD8x6t+2h4a+Hniq10630B59E8zypNQWQBuDjcFxyPxr670XVrTXdLtr+ykWa1uI1ljdehUjINfV4OpTS5aUr236n86cR4fMfawxWPo+zU17qSSVu1lt89T5Y8D/DrRNF1fWLbxrG2kaBLbNYPpetRRzahqJndZJLi6nhkYSQxz+Z5dw8aEGQ/OBgH0v4d6/q/wr8YW/wAN/Fd3NqWnXSs/hjxBcHL3ESjJs527zoOQ38ajPUGp/jx8I9L8TW0/ig2VteXlnArXVpf3T29ndRRCTaZ2VHfZGs07FYwDIrFGJX5a53RPCuvfGL4VXuneM9R+w+PLqKDWbJY7iE/2XOo/cyQxKokiVZFKsH3EkONxyQPo5TVaHPJ6PR+T7r9f6t8PbldkfQtLXBfBP4iS/Ev4f2Wp3sAstct3ksdWsu9veRMUlQjsMjcP9llNd7Xlyi4ScXujoTuro8Q+Knjaxt/i1oFlqHmyab4dt11eeG3jMkk93PKLWyhVO7M8j7fcdutemJ4qh1DxWNAhiieeG1W8vYrhmSWFHJ8lkUoVkBZHBIb5So65r541PxJ4dn+J3xG/4Sq3u5NM1fXLLQUurPzBJYm0sXu0mUxAuGWZVwV5DOD2Nev/AAf03w7cNqGuaR4r1LxpeSrHZy6lqsqvJFGhZ1hULHGAMyEn5dxyMk4GO+tTUYJtPRL01t+t/wADGEm2el1U1TUIdJ0+5vbhtkFvG0jt6ADJq3Xin7W/i5vC3whvoYn2XGpOtonPOCct+leTVmqcHN9D18vwksfi6WFjvNpfefDnxu+JVx4z8Uarrk0hPnyGO3Un7sQJCgfh/OvB7+7Kq8rnnrXS+ML3zLlYQflUVyi6fNr2r2WlWw3TXUyxKB6k4r8+qSlWqXe7P7awtGjlmCUYq0Yr8Ee3fsh/BtvHXiRvEmo2xltbd/LtUcfKz92/Cvtn9o6R/h3+z7qz2gMby7IJGUchWbB/SuE8D/EDwT+zhpOm+H9RtryW8t7SN3+yxBlBZc889e9avjT9q/4X/EnwnqPh/U7PVDZXkRjbdAAV9COeo619VTVGhQdFTSlb8T+b8W80zbOKeZzw050VJNWTa5U+h+dPj7xA2sXEEMGXONqqBySTX6x/sxi8tvhXoVnfFjPBaIrbuo46V8K/CHwL8NfEXxgttN0u41TVr3LyW63duqxIFBJJweT+FfpR4N0JdD0uOJRjioyui4c0273OvxCzaOLqUsJGm4qOvvKz18jfIBGDyK+c9F8K6d8E/iab86drl1p8lz9hjvljtrTSrFbqWPBPz+dcys3koz4blMnGC1fRteCfHvStGTxpousXVzfWupRRLDbT6ZpFndXEMgcsCk10Gjhcg8fKGIXg9BX1WGfvOHRn4tPa5f8AD6/8ID+09r+kqPL0vxrpiaxAnRRe222KfA9XjaJj7qT3r2yvBvitYv4X8V/A7VWu7y+ntddOmS3V+U+0SR3Vu6HzNiqud6xdABx0r3ipraqMu6/LT8kgh1R4j8BbG0uPGXxVa5gSW+svGNxPDI6gtEJLSFcqe2V3D6E17fXiXw7f/hHf2mPilojnYmrWena9bL/eAQ28uPo0a5/3hXr2n61YatNcxWV7BdyWr+VOsMgYxP8A3Wx0PsaWI+Nei/JDpp8unQvV8gft960Y4/CemBsBmmnK/QKv9a+v6+H/APgoNvj8V+EZD/q2tZ1/HcteLmDthpW8vzPv+BqaqZ/h1L+8/wDyVnxVrUxl1CZveuu/Zj0H/hJPjhpQdN8doTcHPTI6VxWof8fU31Ne0fsKWa3Xxe1FmHKWox+LYr5LBxUsRFPuf0pxbWlh8kryj/Lb79D1T4rfsw/ETxZ421LWoNZs0t7yXMMOG+SPoo6elfMevf2j4fuNQsp5o5ntZGhaVBwxBwcV+v8AqzQaX4cubyUKFt7dpNx7YXNfkL4+vPtEN1dMAJLqZpT+JJr0szw9OjZx3Z8L4f5zjc0VWliGnTpqKjZJd/0R6D+w3Zy6h8Yry/AJNrbkBvdjjH5V+p9iCtrHnrivzr/4J3aCZrzXNRZeJJ0jVvYAk1+jMS7Y1HtXs5bHlw8fM/KeOcR9Yzur/dsvuQ+vmr44fDWGz8c3GvS6nMLTW4rhJ4V8DT695AaC2gkbzITiL5beMrvUnJk6r8o+lax/Eni7RvB9rBc61qdtpdvNKII5bqQIrOQSFye+Afyr2qVZ0Zcy/r70z8/9m6vuxV2eL/GTRLbQ/DfwrsLSWWZZPGulTo0wIc5n8x+D8wAGcBuQBjPFfQFeK/FiZfEnxs+EOgwsssdvd3evz7TnCQwGOM/QvMPxFe01dX4IN9U3+LM4/FI8K+PrH4e/EDwB8TVUrY2d02ha3IOiWV0VCyt/sxzLGx9iT2qh8OfDsHwt+LlxZX9/oumLqzTf2dHFIftWqozmTfKMY3ITgEkk5YDA4r2zxj4U07xz4V1bw9q0In03UraS1njPdWUgkehHUHsQK+ZfDGm3epJP4O8RWc2q/ErwCijTl+0i2OuaeJFa3n8w9gUUOM9VIP3qyqx9rSU4/FD8v+B/kelgaypznQqO0Kit036b6f0z6yr5B/4KIaHJJ4X8MazGuVtbqSGRvQOox+or3n4O+P7nxnplzBfXdvqmo2MjRXd7p8RS0Eu4kwxljlygKgsOCR2PFZ37TngM/ET4M+INNjj33UcP2i3H+2nzD+RrzsVH2+Hkl1R73D+I/sjO6FWrtGST9Hp+TPyc1Jf9IYjjcM16/wDsO6tHpfxye2k63lsyL9QQa8aurpduyT5ZEO1gfatf4T+Ll8E/Fnw3rIkxFFdosvP8DHB/nXxWFn7OvGT7n9XcR4X69lNejDVuLt+Z+rH7Q2vf2B8E/ENyG2vJa+Sn1Ygf1r8o/iBcbII489Bmv0J/bO8Y28Hwb0iASgJqVxGwYHgqo3f4V+bfjjVIry4bynDLjAr1M2nzVlFdEfn3hvhXh8rqV5L4pP8ABJf5n3p/wT18P/ZPh7Fdkc3U7ykn8hX2nXzv+xv4f/sX4V6DGU2N9lRjx3Iz/WvoivpMNHkoxXkfgWeV/rOY16veT/MK+Z/iz4j8Yat8UrDwyNFs9e8M3N1CZLa80w3No8LNsf8A0gLiOVNhbac/6w9hmvTPjP8AEay8M6bFosPiMeHtf1FlS0u/shuVgYuoVpVxwjMQmTj71eZ6xBqPw/8ADq+FNCtbez+KPjuUm4gsLmSW1sxyJ75Vb7ihSWwMZYgZNbKm8RNUou3d9jPDSjgaTxVWKfNpFNfiv81fXtozq/g9jx98WPHPj9QH0q32eG9Gfs0UBzcyL6hpsL/2yr22sHwJ4M0/4e+D9J8OaUmyx06BYI89Wxyzt6sxJY+5Nb9dVaanNuO2y9EeJBOK13CvL/jT8IZvH0ena94dvl0Lx7oTNLpGq4+U5+/BMBy8LjgjtnI9/UKKiE5U5KURyipKzPnn4Q6ronxE8cPc6qNQ8J/EHw9F5F74T88RQQZYmSeJFGJYpSQd+T0HQ9e+8PfFm08XeLdc02CKP/hH9OItX1aSRRHNdEDMK5OSQCc8EZ4z2p3xY+CWjfFJbO/aa40PxRpp36b4h01tl1atzxno6HPKNkH9a8C+I0Gu6Pp0Wk/FrQrh7OCaSaDx94RshNAXeMxmW8tdpMb7SPmwQCOCMCtJUVV97D79Y/5d/wAztoV4SlyYxu1rKW/L8v66vc5v4i/sG6B4k1681vR9bvEtNQla4WO2EbRLuOSFOOlceP8AgnrbeYp/tvUxg/8APNP8K+g/AfiPXFuZLnwJq+h+Kvh9p+myJY6dpVwksxaOJBDG6n50kL792TjAGQCa66T4wav4c1fw3oviDwnJ/aWpxxNPPZyYt4WeQJsVnA3sucsoOQBwDXiSwdCLfPTs/Q+4jxBnaioYfF88baara3W/VLc858dfsuP8SvAPhrR9V8Q6mv8AYcHkxsiJmbgAM+R1AGOK8Vl/4J62slwGOtakyhs4Mac/pX1fZ/tCWGsIn2HSbuDZrkGjzLcRq2fM3YdSrYx8uc5PUcVB8X/Hnjvwx480jTPC/h46pp00C3Msi2skm8rMivD5gG2NmQsVLEDIyTVTw+Hn77jc58LnGeYb/Y4VuRauzaS7v77nafCrwv8A8Ij4ZtbJvlW3iWMM3HCjH9KwfEfx+0Wz8Z3Pgi0ke38UOpW1+1R4hkdkDRlTn5gxOB0+63TFch44j8SzXfiiPx54o0vw14Aubd4oEnukhmDbkeJ1ZArdmVlL8++a5zwBrGu67pOn6d8M9D+33ltaGxk+IniG1aC38jeW2wKw3zhSRgDC8ckV6NOjVqr3VyxXV/1/XY+bn9VoXqVp+0m9lHu1e7dtbbNfiWpNWvfAMelax45sovEvxXunmh8P6NZbftZjkwfKnMZ2MiHLbyNqjoc816l8Ivhbe+F7jUPFPiq7TVvHWtBTe3UY/dWkQ5W1t88iJT36sck9gLfwx+DWm/Du4u9WuLu48Q+LdQAF/r+oHdPNj+BB0ijHZFwPXJ5r0Oui8KUPZUfm+r/4H59ey8ytWqYqp7Wrp2S2XkkFFFFYGYUUUUAFNZQylWAKngg0UUAeVeL/ANmH4d+LtQfU/wCxP7C1luTqmgzPYXBPqzREBj7sDWEvwB8c6Hx4d+NniOGFfuw67Z2+pgf8CYI5/FjRRXRHEVFZXuvPX8zN0472Hp8OfjUv7r/hamg+XnPmf8Iou8/7WPPxmnn4F+O9ZONf+NGvSRHrFodhb6cD/wACw7fkwoorWWImlol/4DH/ACFyJ7/mzY8M/sy+AfD9+mpXWly+JdXQ7l1HxFcPfzK3qvmEqp91Ar1RFWNQqqFVRgKBgAUUVyzqTqO83ctRUdkOoooqCgooooA//9k="/>
								<h1 align="center">
									<span style="font-weight:bold; ">
										<xsl:text>E-Arşiv Fatura</xsl:text>
									</span>
								</h1>
								<br/>
								<div class="imgBox" valign="middle">
									<img style="width:140px;height:110px;" align="middle" alt="Imza Logo" src="data:image/jpeg;base64,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"/><br/>
								</div>
							</td>
							<td width="300" align="center" valign="middle">
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gIoSUNDX1BST0ZJTEUAAQEAAAIYAAAAAAQwAABtbnRyUkdCIFhZWiAAAAAAAAAAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAAHRyWFlaAAABZAAAABRnWFlaAAABeAAAABRiWFlaAAABjAAAABRyVFJDAAABoAAAAChnVFJDAAABoAAAAChiVFJDAAABoAAAACh3dHB0AAAByAAAABRjcHJ0AAAB3AAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAFgAAAAcAHMAUgBHAEIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAABvogAAOPUAAAOQWFlaIAAAAAAAAGKZAAC3hQAAGNpYWVogAAAAAAAAJKAAAA+EAAC2z3BhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABYWVogAAAAAAAA9tYAAQAAAADTLW1sdWMAAAAAAAAAAQAAAAxlblVTAAAAIAAAABwARwBvAG8AZwBsAGUAIABJAG4AYwAuACAAMgAwADEANv/bAEMAAwICAgICAwICAgMDAwMEBgQEBAQECAYGBQYJCAoKCQgJCQoMDwwKCw4LCQkNEQ0ODxAQERAKDBITEhATDxAQEP/bAEMBAwMDBAMECAQECBALCQsQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEP/AABEIAE8AaQMBIgACEQEDEQH/xAAWAAEBAQAAAAAAAAAAAAAAAAAAAQn/xAAXEAEAAwAAAAAAAAAAAAAAAAAAARFR/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/xAAVEQEBAAAAAAAAAAAAAAAAAAAAEf/aAAwDAQACEQMRAD8A1QAAAAAAAAAAAAASAAoAAAAAAAAAAAAAAAAAAAAAAAAJU6oAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/9k="/><br/>
							</td>
						</tr>
						<tr width="900" height="180" border="1">
							<td width="300">
								<table id="customerPartyTable" align="left" border="0" height="50%">
									<tbody>
										<tr style="height:71px; ">
											<td>
												<hr/>
												<table align="center" border="0">
													<tbody>
														<tr>
															<xsl:for-each select="n1:Invoice/cac:AccountingCustomerParty/cac:Party">
																<td style="width:469px; " align="left">
																	<span style="font-weight:bold; ">
																		<xsl:text>SAYIN</xsl:text>
																	</span>
																</td>
															</xsl:for-each>
														</tr>
														<tr>
															<xsl:choose>
																<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																	<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																		<xsl:call-template name="Party_Title">
																			<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:when>
																<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='EXPORT']">
																	<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																		<xsl:call-template name="Party_Title">
																			<xsl:with-param name="PartyType">EXPORT</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:when>
																<xsl:otherwise>
																	<xsl:for-each select="n1:Invoice/cac:AccountingCustomerParty/cac:Party">
																		<xsl:call-template name="Party_Title">
																			<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:otherwise>
															</xsl:choose>
														</tr>
														<xsl:choose>
															<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																	<tr>
																		<xsl:call-template name="Party_Adress">
																			<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																		</xsl:call-template>
																	</tr>
																	<xsl:call-template name="Party_Other">
																		<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																	</xsl:call-template>
																</xsl:for-each>
															</xsl:when>
															<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='EXPORT']">
																<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																	<tr>
																		<xsl:call-template name="Party_Adress">
																			<xsl:with-param name="PartyType">EXPORT</xsl:with-param>
																		</xsl:call-template>
																	</tr>
																	<xsl:call-template name="Party_Other">
																		<xsl:with-param name="PartyType">EXPORT</xsl:with-param>
																	</xsl:call-template>
																</xsl:for-each>
															</xsl:when>
															<xsl:otherwise>
																<xsl:for-each select="n1:Invoice/cac:AccountingCustomerParty/cac:Party">
																	<tr>
																		<xsl:call-template name="Party_Adress">
																			<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																		</xsl:call-template>
																	</tr>
																	<xsl:call-template name="Party_Other">
																		<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																	</xsl:call-template>
																</xsl:for-each>
															</xsl:otherwise>
														</xsl:choose>
													</tbody>
												</table>
												<hr/>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
							<td width="25%" align="center" valign="middle">
							</td>
							<td width="300">
								<table border="1" height="13" id="despatchTable">
									<tbody>
										<tr>
											<td style="width:105px;" align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Özelleştirme No:</xsl:text>
												</span>
											</td>
											<td style="width:110px;" align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:CustomizationID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Senaryo:</xsl:text>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:ProfileID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Fatura Tipi:</xsl:text>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:InvoiceTypeCode">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Fatura No:</xsl:text>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:ID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:if test="$earchiveCheckCount &gt; 0">
														Düzenleme Tarihi:
													</xsl:if>
													<xsl:if test="$earchiveCheckCount = 0">
														Fatura Tarihi:
													</xsl:if>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:IssueDate">
														<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'KAGIT' and  //n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentTypeCode = 'SendingType'
										or count(//n1:Invoice/cac:DespatchDocumentReference)=0">
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Düzenleme Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cbc:IssueTime">
															<xsl:value-of select="substring(.,1,2)"/>:<xsl:value-of select="substring(.,4,2)"/>:<xsl:value-of select="substring(.,7,2)"/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'ELEKTRONIK' and  //n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentTypeCode = 'SendingType'">
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Düzenleme Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cbc:IssueTime">
															<xsl:value-of select="substring(.,1,2)"/>:<xsl:value-of select="substring(.,4,2)"/>:<xsl:value-of select="substring(.,7,2)"/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:for-each select="n1:Invoice/cac:DespatchDocumentReference[position() &lt;2]">
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye No-Tarih:</xsl:text>
													</span>
													<span>
														<xsl:text>&#160;</xsl:text>
														<xsl:if test="$irsaliyeCount &gt; 1">
															<xsl:text>(</xsl:text>
															<xsl:value-of select="$irsaliyeCount"/>
															<xsl:text>) </xsl:text>
														</xsl:if>
													</span>
												</td>
												<td align="left">
													<xsl:value-of select="cbc:ID"/>-
													<xsl:for-each select="cbc:IssueDate">
														<xsl:value-of select="substring(.,9,2)"/>.<xsl:value-of select="substring(.,6,2)"/>.<xsl:value-of select="substring(.,1,4)"/>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:for-each>
										<!--	<xsl:for-each select="n1:Invoice/cac:BillingReference[position() &lt;2]">
											<tr style="height:13px">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İade Fatura No - Tarih:</xsl:text>
													</span>
													<span>
														<xsl:text>&#160;</xsl:text>
														<xsl:if test="$iadeCount &gt; 1">
															<xsl:text>(</xsl:text>
															<xsl:value-of select="$iadeCount" />
															<xsl:text>) </xsl:text>
														</xsl:if>
													</span>
												</td>
												<td align="left">
													<xsl:value-of select="cac:InvoiceDocumentReference/cbc:ID" />-
													<xsl:for-each select="cac:InvoiceDocumentReference/cbc:IssueDate">
														<xsl:value-of select="substring(.,9,2)" />.<xsl:value-of select="substring(.,6,2)" />.<xsl:value-of select="substring(.,1,4)" />
													</xsl:for-each>
												</td>
											</tr>
										</xsl:for-each>-->
										<xsl:if test="//n1:Invoice/cac:OrderReference">
											<tr style="height:13px">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sipariş No:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice/cac:OrderReference">
														<xsl:for-each select="cbc:ID">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:if test="//n1:Invoice/cac:OrderReference/cbc:IssueDate">
											<tr style="height:13px">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sipariş Tarihi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice/cac:OrderReference">
														<xsl:for-each select="cbc:IssueDate">
															<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:for-each select="n1:Invoice/cac:TaxRepresentativeParty/cac:PartyIdentification/cbc:ID[@schemeID='ARACIKURUMVKN']">
											<tr>
												<td style="width:105px;" align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Aracı Kurum VKN:</xsl:text>
													</span>
												</td>
												<td style="width:110px;" align="left">
													<xsl:value-of select="."/>
												</td>
											</tr>
											<tr>
												<td style="width:105px;" align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Aracı Kurum Unvan:</xsl:text>
													</span>
												</td>
												<td style="width:110px;" align="left">
													<xsl:value-of select="../../cac:PartyName/cbc:Name"/>
												</td>
											</tr>
										</xsl:for-each>
									</tbody>
								</table>
							</td>
						</tr>
						<tr align="left">
							<table id="ettnTable">
								<tr style="height:13px;">
									<td align="left" valign="top">
										<span style="font-weight:bold; ">
											<xsl:text>ETTN:</xsl:text>
										</span>
									</td>
									<td align="left" width="240px">
										<xsl:for-each select="n1:Invoice">
											<xsl:for-each select="cbc:UUID">
												<xsl:apply-templates/>
											</xsl:for-each>
										</xsl:for-each>
									</td>
								</tr>
							</table>
						</tr>
						<xsl:if test="//n1:Invoice/cac:AccountingCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID] ='7750409379'">
							<tr>
								<td>
									<br/>
								</td>
							</tr>
							<tr>
								<td>
									<table border="1">
										<tbody>
											<tr>
												<td style="width:105px; " align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sağlık Fatura Tipi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cbc:AccountingCost">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Eczane Sicil No:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Mükellef Kodu:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:AdditionalDocumentReference[cbc:DocumentTypeCode='MUKELLEF_KODU']/cbc:DocumentType">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Eczane Adı:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Mükellef Adı:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:AdditionalDocumentReference[cbc:DocumentTypeCode='MUKELLEF_ADI']/cbc:DocumentType">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Döküm No:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Dosya No:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:AdditionalDocumentReference[cbc:DocumentTypeCode='DOSYA_NO']/cbc:DocumentType">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Reçete Dönemi:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Dönem:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:InvoicePeriod/cbc:StartDate">
															<xsl:apply-templates/>
														</xsl:for-each>
														<span>
															<xsl:text> / </xsl:text>
														</span>
														<xsl:for-each select="cac:InvoicePeriod/cbc:EndDate">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<br/>
								</td>
							</tr>
						</xsl:if>
					</table>
					<div id="lineTableAligner">
						<span>
							<xsl:text>&#160;</xsl:text>
						</span>
					</div>
					<table border="1" id="lineTable" width="800">
						<tbody>
							<tr id="lineTableTr">
								<td id="lineTableTd" style="width:3%">
									<span style="font-weight:bold; " align="center">
										<xsl:text>Sıra No</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:Item/cac:SellersItemIdentification">
									<td id="lineTableTd" style="width:3%">
										<span style="font-weight:bold; " align="center">
											<xsl:text>Stok Kodu</xsl:text>
										</span>
									</td>
								</xsl:if>
								<td id="lineTableTd" style="width:20%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Malzeme/Hizmet Açıklaması</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:7.4%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Miktar</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:9%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Birim Fiyat</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:MultiplierFactorNumeric &gt;0">
									<td id="lineTableTd" style="width:7%" align="center">
										<span style="font-weight:bold; ">
											<xsl:text>İskonto Oranı&#160;%</xsl:text>
										</span>
									</td>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:Amount &gt;0">
									<td id="lineTableTd" style="width:9%" align="center">
										<span style="font-weight:bold; ">
											<xsl:text>İskonto Tutarı&#160;&#160;</xsl:text>
										</span>
									</td>
								</xsl:if>
								<td id="lineTableTd" style="width:7%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Oranı</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Tutarı</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode!='0015'">
									<td id="lineTableTd" style="width:17%; " align="center">
										<span style="font-weight:bold; ">
											<xsl:text>Diğer Vergiler</xsl:text>
										</span>
									</td>
								</xsl:if>
								<td id="lineTableTd" style="width:10.6%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Mal Hizmet Tutarı</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS'">
									<td id="lineTableTd" style="width:5%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Künye Numarası</xsl:text>
										</span>
									</td>
								</xsl:if>
								<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='SATIS') or (//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU') ">
									<td id="lineTableTd" style="width:5%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Mal Sahibi VKN/TCKN - Ad/Soyad</xsl:text>
										</span>
									</td>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cbc:ProfileID='IHRACAT'">
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Teslim Şartı</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Eşya Kap Cinsi</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Kap No</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Kap Adet</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Teslim/Bedel Ödeme Yeri</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Gönderilme Şekli</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>GTİP</xsl:text>
										</span>
									</td>
								</xsl:if>
							</tr>
							<xsl:if test="count(//n1:Invoice/cac:InvoiceLine) &gt;= 6">
								<xsl:for-each select="//n1:Invoice/cac:InvoiceLine">
									<xsl:apply-templates select="."/>
								</xsl:for-each>
							</xsl:if>
							<xsl:if test="count(//n1:Invoice/cac:InvoiceLine) &lt; 6">
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[1]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[1]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[2]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[2]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[3]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[3]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[4]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[4]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[5]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[5]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[6]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[6]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[7]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[7]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[8]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[8]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[9]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[9]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[10]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[10]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
							</xsl:if>
						</tbody>
					</table>
				</xsl:for-each>
				<table id="budgetContainerTable" width="800px">
					<tbody>
						<tr>
							<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU'">
								<td align="left" valign="top" width="300px ">
									<table border='1' cellpadding='0'>
										<tbody>
											<xsl:for-each select="n1:Invoice/cac:AllowanceCharge">
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSKOMISYON'">
													<tr align="center">
														<span style="font-weight:bold; ">
															<th>Masraflar:</th>
															<th>Oran:</th>
															<th>Tutar:</th>
														</span>
													</tr>
													<tr align="left">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Komisyon </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSKOMISYONKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Komisyon KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAVLUN'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Navlun </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAVLUNKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Navlun KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSHAMMALIYE'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Hammaliye </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSHAMMALIYEKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Hammaliye KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAKLIYE'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Nakliye </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAKLIYEKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Nakliye KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSGVTEVKIFAT'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>G.V. Tevkifat </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSBAGKURTEVKIFAT'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Bağkur Tevkifat </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSRUSUM'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Rüsum </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSRUSUMKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Rüsum KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSTICBORSASI'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Ticaret Borsası </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSTICBORSASIKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Ticaret Borsası KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSMILLISAVUNMAFON'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Milli Savunma Fon </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSMSFONKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Milli Savunma Fon KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSDIGERMASRAFLAR'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Diğer Masraflar </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSDIGERKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Diğer KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
											</xsl:for-each>
										</tbody>
									</table>
								</td>
							</xsl:if>
							<td valign="top">
								<table id="budgetContainerTable" width="350px" align='right'>
									<tr id="budgetContainerTr" align="right">
										<td id="budgetContainerDummyTd"/>
										<td id="lineTableBudgetTd" align="right" width="200px">
											<span style="font-weight:bold; ">
												<xsl:text>Mal Hizmet Toplam Tutarı</xsl:text>
											</span>
										</td>
										<td id="lineTableBudgetTd" style="width:81px; " align="right">
											<span>
												<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount, '###.##0,00', 'european')"/>
												<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID">
													<xsl:text>
													</xsl:text>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID = 'TRY'">
														<xsl:text>TL</xsl:text>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
														<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID"/>
													</xsl:if>
												</xsl:if>
											</span>
										</td>
									</tr>
									<xsl:if test="//n1:Invoice/cac:Delivery/cac:Shipment/cbc:InsuranceValueAmount">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Sigorta Tutarı</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:value-of select="format-number(//n1:Invoice/cac:Delivery/cac:Shipment/cbc:InsuranceValueAmount, '###.##0,00', 'european')"/>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID">
														<xsl:text>
														</xsl:text>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
															<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</span>
											</td>
										</tr>
									</xsl:if>
									<xsl:if test="//n1:Invoice/cac:Delivery/cac:Shipment/cbc:DeclaredForCarriageValueAmount">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Navlun Tutarı</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:value-of select="format-number(//n1:Invoice/cac:Delivery/cac:Shipment/cbc:DeclaredForCarriageValueAmount, '###.##0,00', 'european')"/>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID">
														<xsl:text>
														</xsl:text>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
															<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</span>
											</td>
										</tr>
									</xsl:if>
									<tr id="budgetContainerTr" align="right">
										<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount &gt;0">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" align="right" width="200px">
												<xsl:if test="//n1:Invoice/cac:AllowanceCharge/cbc:ChargeIndicator">
													<span style="font-weight:bold; ">
														<xsl:text>Toplam İndirim İskonto</xsl:text>
													</span>
												</xsl:if>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount &gt;0">
														<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount, '###.##0,00', 'european')"/>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount">
															<xsl:text>
															</xsl:text>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount/@currencyID = 'TRY'">
																<xsl:text>TL</xsl:text>
															</xsl:if>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount/@currencyID != 'TRY'">
																<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount/@currencyID"/>
															</xsl:if>
														</xsl:if>
													</xsl:if>
												</span>
											</td>
										</xsl:if>
									</tr>
									<xsl:if test="//n1:Invoice/cbc:ProfileID!='HKS' and //n1:Invoice/cbc:InvoiceTypeCode!='KOMISYONCU'">
										<tr id="budgetContainerTr" align="right">
											<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount &gt;0">
												<td id="budgetContainerDummyTd"/>
												<td id="lineTableBudgetTd" align="right" width="200px">
													<xsl:if test="//n1:Invoice/cac:AllowanceCharge/cbc:ChargeIndicator">
														<span style="font-weight:bold; ">
															<xsl:text>Toplam Arttırım İskonto</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td id="lineTableBudgetTd" style="width:81px; " align="right">
													<span>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount &gt;0">
															<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount, '###.##0,00', 'european')"/>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount">
																<xsl:text>
																</xsl:text>
																<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount/@currencyID = 'TRY'">
																	<xsl:text>TL</xsl:text>
																</xsl:if>
																<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount/@currencyID != 'TRY'">
																	<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount/@currencyID"/>
																</xsl:if>
															</xsl:if>
														</xsl:if>
													</span>
												</td>
											</xsl:if>
										</tr>
									</xsl:if>
									<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU') or (//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='SATIS')">
										<tr id="budgetContainerTr" align="right">
											<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount &gt;0">
												<td id="budgetContainerDummyTd"/>
												<td id="lineTableBudgetTd" width="200px" align="right">
													<span style="font-weight:bold; ">
														<xsl:text>Toplam Masraflar</xsl:text>
													</span>
												</td>
												<td id="lineTableBudgetTd" style="width:82px; " align="right">
													<xsl:for-each select="n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount">
														<xsl:call-template name="Curr_Type"/>
													</xsl:for-each>
												</td>
											</xsl:if>
										</tr>
									</xsl:if>
									<xsl:for-each select="n1:Invoice/cac:TaxTotal/cac:TaxSubtotal">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="211px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Hesaplanan </xsl:text>
													<xsl:value-of select="cac:TaxCategory/cac:TaxScheme/cbc:Name"/>
													<xsl:text>(%</xsl:text>
													<xsl:value-of select="cbc:Percent"/>
													<xsl:text>)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:for-each select="cac:TaxCategory/cac:TaxScheme">
													<xsl:text>
													</xsl:text>
													<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
													<xsl:if test="../../cbc:TaxAmount/@currencyID">
														<xsl:text>
														</xsl:text>
														<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRY'">
															<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:for-each>
									<xsl:for-each select="n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="211px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Hesaplanan KDV Tevkifat</xsl:text>
													<xsl:text>(%</xsl:text>
													<xsl:value-of select="cbc:Percent"/>
													<xsl:text>)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:for-each select="cac:TaxCategory/cac:TaxScheme">
													<xsl:text> </xsl:text>
													<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
													<xsl:if test="../../cbc:TaxAmount/@currencyID">
														<xsl:text> </xsl:text>
														<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRL' or ../../cbc:TaxAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRL' and ../../cbc:TaxAmount/@currencyID != 'TRY'">
															<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:for-each>
									<xsl:if test="n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="211px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Tevkifata Tabi İşlem Tutarı</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:if test="n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
													<xsl:value-of select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
												</xsl:if>
												<xsl:if test="//n1:Invoice/cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=&apos;9015&apos;">
													<xsl:value-of select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=9015]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
												</xsl:if>
												<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode = 'TRL' or n1:Invoice/cbc:DocumentCurrencyCode = 'TRY'">
													<xsl:text>&#160;TL</xsl:text>
												</xsl:if>
												<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode != 'TRL' and n1:Invoice/cbc:DocumentCurrencyCode != 'TRY'">
													<xsl:value-of select="n1:Invoice/cbc:DocumentCurrencyCode"/>
												</xsl:if>
											</td>
										</tr>
										<!-- 	<xsl:if test = "n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
											<tr id="budgetContainerTr" align="right">
												<td id="budgetContainerDummyTd"/>
												<td id="lineTableBudgetTd" width="211px" align="right">
													<span style="font-weight:bold; ">
														<xsl:text>Tevkifata Tabi İşlem Tutarı</xsl:text>
													</span>
												</td>
												<td id="lineTableBudgetTd" style="width:82px; " align="right">
													<xsl:if test = "n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
														<xsl:value-of
										select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
													</xsl:if>
													<xsl:if test = "//n1:Invoice/cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=&apos;9015&apos;">
														<xsl:value-of
										select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=9015]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
													</xsl:if>
													<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode = 'TRL' or n1:Invoice/cbc:DocumentCurrencyCode = 'TRY'">
														<xsl:text>&#160;TL</xsl:text>
													</xsl:if>
													<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode != 'TRL' and n1:Invoice/cbc:DocumentCurrencyCode != 'TRY'">
														<xsl:value-of select="n1:Invoice/cbc:DocumentCurrencyCode"/>
													</xsl:if>
												</td>
											</tr>
										</xsl:if> -->
									</xsl:if>
									<tr id="budgetContainerTr" align="right">
										<td id="budgetContainerDummyTd"/>
										<td id="lineTableBudgetTd" width="200px" align="right">
											<span style="font-weight:bold; ">
												<xsl:text>Vergiler Dahil Toplam Tutar</xsl:text>
											</span>
										</td>
										<td id="lineTableBudgetTd" style="width:82px; " align="right">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:LegalMonetaryTotal">
													<xsl:for-each select="cbc:TaxInclusiveAmount">
														<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID">
															<xsl:text>
															</xsl:text>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID = 'TRY'">
																<xsl:text>TL</xsl:text>
															</xsl:if>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID != 'TRY'">
																<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID"/>
															</xsl:if>
														</xsl:if>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</td>
									</tr>
									<tr id="budgetContainerTr" align="right">
										<td id="budgetContainerDummyTd"/>
										<td id="lineTableBudgetTd" width="200px" align="right">
											<span style="font-weight:bold; ">
												<xsl:text>Ödenecek Tutar</xsl:text>
											</span>
										</td>
										<td id="lineTableBudgetTd" style="width:82px; " align="right">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:LegalMonetaryTotal">
													<xsl:for-each select="cbc:PayableAmount">
														<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID">
															<xsl:text>
															</xsl:text>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID = 'TRY'">
																<xsl:text>TL</xsl:text>
															</xsl:if>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID != 'TRY'">
																<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID"/>
															</xsl:if>
														</xsl:if>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</td>
									</tr>
									<xsl:if test="//n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Döviz Kuru</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cac:PricingExchangeRate">
														<xsl:for-each select="cbc:CalculationRate">
															<xsl:value-of select="format-number(., '###0,0000', 'european')"/>
															<xsl:if test="//n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate">
																<xsl:text>
																</xsl:text>
															</xsl:if>
														</xsl:for-each>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:if>
									<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
										<tr align="right">
											<td/>
											<td id="lineTableBudgetTd" align="right" width="200px">
												<span style="font-weight:bold; ">
													<xsl:text>Mal Hizmet Toplam Tutarı(TL)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount * //n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate, '###.##0,00', 'european')"/>
													<xsl:text> TL</xsl:text>
												</span>
											</td>
										</tr>
										<tr id="budgetContainerTr" align="right">
											<td/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Vergiler Dahil Toplam Tutar(TL)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount * //n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate, '###.##0,00', 'european')"/>
												<xsl:text> TL</xsl:text>
											</td>
										</tr>
										<tr align="right">
											<td/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Ödenecek Tutar(TL)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount * //n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate, '###.##0,00', 'european')"/>
												<xsl:text> TL</xsl:text>
											</td>
										</tr>
									</xsl:if>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<br/>
				<xsl:if test="//n1:Invoice/cac:BillingReference/cac:InvoiceDocumentReference/cbc:DocumentTypeCode[text()='İADE' or text()='IADE']">
					<table id="lineTable" width="800">
						<thead>
							<tr>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;İadeye Konu Olan Faturalar</span>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr align="left" class="lineTableTr">
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Fatura No</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Tarih</span>
								</td>
							</tr>
							<xsl:for-each select="//n1:Invoice/cac:BillingReference/cac:InvoiceDocumentReference/cbc:DocumentTypeCode[text()='İADE' or text()='IADE']">
								<tr align="left" class="lineTableTr">
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="../cbc:ID"/>
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:for-each select="../cbc:IssueDate">
											<xsl:apply-templates select="."/>
										</xsl:for-each>
									</td>
								</tr>
							</xsl:for-each>
						</tbody>
					</table>
				</xsl:if>
				<br/>
				<xsl:if test="//n1:Invoice/cac:BillingReference/cac:AdditionalDocumentReference/cbc:DocumentTypeCode='OKCBF'">
					<table border="1" id="lineTable" width="800">
						<thead>
							<tr>
								<th colspan="6">ÖKC Bilgileri</th>
							</tr>
						</thead>
						<tbody>
							<tr id="okcbfHeadTr" style="font-weight:bold;">
								<td style="width:20%">
									<xsl:text>Fiş Numarası</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>Fiş Tarihi</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>Fiş Saati</xsl:text>
								</td>
								<td style="width:40%" align="center">
									<xsl:text>Fiş Tipi</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>Z Rapor No</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>ÖKC Seri No</xsl:text>
								</td>
							</tr>
						</tbody>
						<xsl:for-each select="//n1:Invoice/cac:BillingReference/cac:AdditionalDocumentReference/cbc:DocumentTypeCode[text()='OKCBF']">
							<tr>
								<td style="width:20%">
									<xsl:value-of select="../cbc:ID"/>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="../cbc:IssueDate"/>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="substring(../cac:ValidityPeriod/cbc:StartTime,1,5)"/>
								</td>
								<td style="width:40%" align="center">
									<xsl:choose>
										<xsl:when test="../cbc:DocumentDescription='AVANS'">
											<xsl:text>Ön Tahsilat(Avans) Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='YEMEK_FIS'">
											<xsl:text>Yemek Fişi/Kartı ile Yapılan Tahsilat Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-FATURA'">
											<xsl:text>E-Fatura Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-FATURA_IRSALIYE'">
											<xsl:text>İrsaliye Yerine Geçen E-Fatura Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-ARSIV'">
											<xsl:text>E-Arşiv Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-ARSIV_IRSALIYE'">
											<xsl:text>İrsaliye Yerine Geçen E-Arşiv Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='FATURA'">
											<xsl:text>Faturalı Satış Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='OTOPARK'">
											<xsl:text>Otopark Giriş Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='FATURA_TAHSILAT'">
											<xsl:text>Fatura Tahsilat Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='FATURA_TAHSILAT_KOMISYONLU'">
											<xsl:text>Komisyonlu Fatura Tahsilat Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:otherwise>
											<xsl:text> </xsl:text>
										</xsl:otherwise>
									</xsl:choose>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="../cac:Attachment/cac:ExternalReference/cbc:URI"/>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="../cac:IssuerParty/cbc:EndpointID"/>
								</td>
							</tr>
						</xsl:for-each>
					</table>
					<br/>
				</xsl:if>
				<table id="notesTable" width="800" height="100">
					<tbody>
						<tr align="left">
							<td id="notesTableTd">
								<xsl:for-each select="//n1:Invoice/cac:TaxTotal/cac:TaxSubtotal">
									<xsl:if test="(cbc:Percent=0 and cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=&apos;0015&apos;) or (//n1:Invoice/cbc:InvoiceTypeCode='ISTISNA') or (//n1:Invoice/cbc:InvoiceTypeCode='IHRACKAYITLI') or (//n1:Invoice/cbc:InvoiceTypeCode='OZELMATRAH')">
										<b>Vergi İstisna Muafiyet Sebebi: </b>
										<xsl:value-of select="cac:TaxCategory/cbc:TaxExemptionReason"/>
										<br/>
									</xsl:if>
								</xsl:for-each>
								<xsl:for-each select="//n1:Invoice/cac:AllowanceCharge">
									<xsl:if test="cbc:AllowanceChargeReason!= '' and cbc:AllowanceChargeReason!= 'HKSKOMISYON' and cbc:AllowanceChargeReason!= 'HKSKOMISYONKDV' and cbc:AllowanceChargeReason!= 'HKSNAVLUN' and cbc:AllowanceChargeReason!= 'HKSNAVLUNKDV' and cbc:AllowanceChargeReason!= 'HKSHAMMALIYE' and cbc:AllowanceChargeReason!= 'HKSHAMMALIYEKDV' and cbc:AllowanceChargeReason!= 'HKSNAKLIYE' and cbc:AllowanceChargeReason!= 'HKSNAKLIYEKDV' and cbc:AllowanceChargeReason!= 'HKSGVTEVKIFAT' and cbc:AllowanceChargeReason!= 'HKSBAGKURTEVKIFAT' and cbc:AllowanceChargeReason!= 'HKSRUSUM' and cbc:AllowanceChargeReason!= 'HKSRUSUMKDV' and cbc:AllowanceChargeReason!= 'HKSTICBORSASI' and cbc:AllowanceChargeReason!= 'HKSTICBORSASIKDV' and cbc:AllowanceChargeReason!= 'HKSMILLISAVUNMAFON' and cbc:AllowanceChargeReason!= 'HKSMSFONKDV' and cbc:AllowanceChargeReason!= 'HKSDIGERMASRAFLAR' and cbc:AllowanceChargeReason!= 'HKSDIGERKDV'">
										<b>
											<xsl:value-of select="cbc:AllowanceChargeReason"/>
										</b> :&#160;
										<xsl:value-of select="cbc:Amount"/>
										<xsl:if test="cbc:Amount/@currencyID = 'TRY'">
											<xsl:text>TL</xsl:text>
										</xsl:if>
										<xsl:if test="cbc:Amount/@currencyID != 'TRY'">
											<xsl:value-of select="cbc:Amount/@currencyID"/>
										</xsl:if>
										<br/>
									</xsl:if>
								</xsl:for-each>
								<xsl:for-each select="//n1:Invoice/cac:WithholdingTaxTotal">
									<xsl:if test="//n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:Name">
										<b>Tevkifat  Sebebi: </b>
										<xsl:value-of select="//n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode"/>
										-
										<xsl:value-of select="//n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:Name"/>
										<br/>
									</xsl:if>
								</xsl:for-each>
								<br/>
								<b>Yalnız: </b>
								<xsl:for-each select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount">
									<xsl:call-template name="dovizi_oku">
										<xsl:with-param name="doviz" select="@currencyID"/>
									</xsl:call-template>
								</xsl:for-each>
								<br/>
								<xsl:if test="$irsaliyeCount &gt; 1">
									<b> İrsaliyeler :  </b>
									<xsl:for-each select="//n1:Invoice/cac:DespatchDocumentReference[position() &gt; 1]">
										<xsl:value-of select="cbc:ID"/>-
										<xsl:for-each select="cbc:IssueDate">
											<xsl:value-of select="substring(.,9,2)"/>/<xsl:value-of select="substring(.,6,2)"/>/<xsl:value-of select="substring(.,1,4)"/>
										</xsl:for-each>
										<xsl:text>,&#160;&#160;</xsl:text>
									</xsl:for-each>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cbc:Note">
									<br/>
									<xsl:for-each select="//n1:Invoice/cbc:Note">
										<b>Not : </b>
										<xsl:value-of select="."/>
										<br/>
									</xsl:for-each>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:PaymentMeans/cbc:PaymentDueDate">
									<b> Ödeme Tarihi: </b>
									<xsl:value-of select="//n1:Invoice/cac:PaymentMeans/cbc:PaymentDueDate"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:PaymentMeans/cac:PayeeFinancialAccount/cbc:PaymentNote">
									<b> Hesap Açıklaması: </b>
									<xsl:value-of select="//n1:Invoice/cac:PaymentMeans/cac:PayeeFinancialAccount/cbc:PaymentNote"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:PaymentTerms/cbc:Note">
									<b> Ödeme Koşulu: </b>
									<xsl:value-of select="//n1:Invoice/cac:PaymentTerms/cbc:Note"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE']='TAXFREE' and //n1:Invoice/cac:TaxRepresentativeParty/cac:PartyTaxScheme/cbc:ExemptionReasonCode">
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160; VAT OFF - NO CASH REFUND </b>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyName/cbc:Name">
									<b> Gönderiyi Taşıyan Unvan : </b>
									<xsl:value-of select="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyIdentification/cbc:ID">
									<b> Gönderiyi Taşıyan VKN/TCKN : </b>
									<xsl:value-of select="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyIdentification/cbc:ID"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery/cac:Despatch/cbc:ActualDespatchDate">
									<b> Gönderim Tarihi : </b>
									<xsl:value-of select="//n1:Invoice/cac:Delivery/cac:Despatch/cbc:ActualDespatchDate"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'ELEKTRONIK' ">
									<span style="font-weight:bold;color:blue; ">
										<xsl:text>e-Arşiv izni kapsamında elektronik ortamda iletilmiştir.</xsl:text>
										<br/>
									</span>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery  and //n1:Invoice/cbc:ProfileID!='IHRACAT'">
									<span style="font-weight:bold;color:blue; ">
										<xsl:text>Bu satış internet üzerinden yapılmıştır.</xsl:text>
									</span>
									<br/>
								</xsl:if>
								<xsl:if test="count(//n1:Invoice/cac:DespatchDocumentReference)=0">
									<span style="font-weight:bold;color:blue; ">
										<xsl:text>İrsaliye yerine geçer.</xsl:text>
									</span>
									<br/>
								</xsl:if>
							</td>
						</tr>
					</tbody>
				</table>
				<xsl:if test="//n1:Invoice/cac:PaymentMeans != ''">
					<table width="800px" border="2">
						<tr>
							<th>Banka Adı</th>
							<th>Şube Adı</th>
							<th>IBAN</th>
							<th>Para Birimi</th>
						</tr>
						<xsl:for-each select="n1:Invoice/cac:PaymentMeans">
							<tr align="center">
								<td>
									<xsl:value-of select="cac:PayeeFinancialAccount/cac:FinancialInstitutionBranch/cac:FinancialInstitution/cbc:Name"/>
								</td>
								<td>
									<xsl:value-of select="cac:PayeeFinancialAccount/cac:FinancialInstitutionBranch/cbc:Name"/>
								</td>
								<td>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,1,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,5,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,9,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,13,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,17,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,21,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,25,2)"/>
								</td>
								<td>
									<xsl:value-of select="cac:PayeeFinancialAccount/cbc:CurrencyCode"/>
								</td>
							</tr>
						</xsl:for-each>
					</table>
				</xsl:if>
				<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'INTERNET' and  //n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentTypeCode = 'EArchiveType'">
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<table border="1" align="left" id="lineTable" width="800">
						<tbody>
							<tr align="left">
								<td>
									<b>
										<xsl:text>İade Bölümü</xsl:text>
									</b>
								</td>
							</tr>
							<tr align="left" id="lineTableTr">
								<td id="lineTableTd" style="width:20%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Malzeme/Hizmet Açıklaması</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:7.4%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Miktar</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:9%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Birim Fiyat</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:7%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Oranı</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Tutarı</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:10.6%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Mal Hizmet Tutarı</xsl:text>
									</span>
								</td>
							</tr>
							<tr align="left">
								<td>
									<br/>
								</td>
								<br/>
								<td>
									<br/>
								</td>
								<br/>
								<td/>
								<br/>
								<td/>
								<br/>
								<td/>
								<td>
									<br/>
								</td>
							</tr>
							<tr align="left">
								<td>
									<br/>
								</td>
								<br/>
								<td>
									<br/>
								</td>
								<br/>
								<td/>
								<br/>
								<td/>
								<br/>
								<td/>
								<td>
									<br/>
								</td>
							</tr>
							<tr align="left">
								<td>
									<br/>
								</td>
								<br/>
								<td>
									<br/>
								</td>
								<br/>
								<td/>
								<br/>
								<td/>
								<br/>
								<td/>
								<td>
									<br/>
								</td>
							</tr>
						</tbody>
					</table>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<b>
						<xsl:text>Firma/Şahıs Unvanı :</xsl:text>
					</b>
					<br/>
					<b>
						<xsl:text>Vkn/Tckno :</xsl:text>
					</b>
					<br/>
					<b>
						<xsl:text>İmza Kaşe</xsl:text>
					</b>
					<br/>
				</xsl:if>
			</body>
		</html>
	</xsl:template>
	<xsl:template name="dovizi_oku">
		<xsl:param name="doviz"/>
		<xsl:variable name="okunacak" select="."/>
		<xsl:variable name="noktadan_sonra" select="round(($okunacak - floor($okunacak)) * 100)"/>
		<xsl:call-template name="sayi_oku">
			<xsl:with-param name="okunacak" select="."/>
		</xsl:call-template>
		<xsl:if test="$doviz">
			<xsl:choose>
				<xsl:when test="$doviz =  'TRL' or $doviz =  'TRY'">
					<xsl:value-of select="' Türk Lirası'"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
						<xsl:value-of select="' Kuruş'"/>
					</xsl:if>
				</xsl:when>
				<xsl:when test="$doviz =  'EUR' or $doviz =  'EUR'">
					<xsl:value-of select="' EURO '"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
						<xsl:value-of select="' Cent'"/>
					</xsl:if>
				</xsl:when>
				<xsl:when test="$doviz =  'USD' or $doviz =  'USD'">
					<xsl:value-of select="' USD '"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
						<xsl:value-of select="' Cent'"/>
					</xsl:if>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="$doviz"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
					</xsl:if>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:if>
	</xsl:template>
	<xsl:template name="sayi_oku">
		<xsl:param name="okunacak"/>
		<xsl:variable name="tam_sayi" select="floor($okunacak)"/>
		<xsl:variable name="birler" select="floor($okunacak) mod 10"/>
		<xsl:variable name="onlar" select="floor(floor($tam_sayi mod 100) div 10)"/>
		<xsl:variable name="yuzler" select="floor(floor($tam_sayi mod 1000) div 100)"/>
		<xsl:variable name="binler" select="floor(floor($tam_sayi mod 1000000) div 1000)"/>
		<xsl:variable name="milyonlar" select="floor(floor($tam_sayi mod 1000000000) div 1000000)"/>
		<xsl:variable name="milyarlar" select="floor(floor($tam_sayi mod 1000000000000) div 1000000000)"/>
		<xsl:if test="$milyarlar &gt; 0">
			<xsl:call-template name="sayi_oku_3hane">
				<xsl:with-param name="sayi" select="$milyarlar"/>
			</xsl:call-template> Milyar
		</xsl:if>
		<xsl:if test="$milyonlar &gt; 0">
			<xsl:call-template name="sayi_oku_3hane">
				<xsl:with-param name="sayi" select="$milyonlar"/>
			</xsl:call-template> Milyon
		</xsl:if>
		<xsl:if test="$binler &gt; 0">
			<xsl:if test="$binler = 1">Bin </xsl:if>
			<xsl:if test="$binler > 1">
				<xsl:call-template name="sayi_oku_3hane">
					<xsl:with-param name="sayi" select="$binler"/>
				</xsl:call-template> Bin
			</xsl:if>
		</xsl:if>
		<xsl:call-template name="yuzler_oku">
			<xsl:with-param name="sayi" select="$yuzler"/>
		</xsl:call-template>
		<xsl:call-template name="onlar_oku">
			<xsl:with-param name="sayi" select="$onlar"/>
		</xsl:call-template>
		<xsl:call-template name="birler_oku">
			<xsl:with-param name="sayi" select="$birler"/>
		</xsl:call-template>
	</xsl:template>
	<xsl:template name="sayi_oku_3hane">
		<xsl:param name="sayi"/>
		<xsl:variable name="tam_sayi" select="floor($sayi)"/>
		<xsl:variable name="birler" select="floor($sayi) mod 10"/>
		<xsl:variable name="onlar" select="floor(floor($tam_sayi mod 100) div 10)"/>
		<xsl:variable name="yuzler" select="floor(floor($tam_sayi mod 1000) div 100)"/>
		<xsl:call-template name="yuzler_oku">
			<xsl:with-param name="sayi" select="$yuzler"/>
		</xsl:call-template>
		<xsl:call-template name="onlar_oku">
			<xsl:with-param name="sayi" select="$onlar"/>
		</xsl:call-template>
		<xsl:call-template name="birler_oku">
			<xsl:with-param name="sayi" select="$birler"/>
		</xsl:call-template>
	</xsl:template>
	<xsl:template name="birler_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">Bir </xsl:when>
			<xsl:when test="$sayi =  2">İki </xsl:when>
			<xsl:when test="$sayi =  3">Üç </xsl:when>
			<xsl:when test="$sayi =  4">Dört </xsl:when>
			<xsl:when test="$sayi =  5">Beş </xsl:when>
			<xsl:when test="$sayi =  6">Altı </xsl:when>
			<xsl:when test="$sayi =  7">Yedi </xsl:when>
			<xsl:when test="$sayi =  8">Sekiz </xsl:when>
			<xsl:when test="$sayi =  9">Dokuz </xsl:when>
			<xsl:otherwise> </xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="onlar_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">On </xsl:when>
			<xsl:when test="$sayi =  2">Yirmi </xsl:when>
			<xsl:when test="$sayi =  3">Otuz </xsl:when>
			<xsl:when test="$sayi =  4">Kırk </xsl:when>
			<xsl:when test="$sayi =  5">Elli </xsl:when>
			<xsl:when test="$sayi =  6">Altmış </xsl:when>
			<xsl:when test="$sayi =  7">Yetmiş </xsl:when>
			<xsl:when test="$sayi =  8">Seksen </xsl:when>
			<xsl:when test="$sayi =  9">Doksan </xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="yuzler_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">Yüz </xsl:when>
			<xsl:when test="$sayi =  2">İki Yüz </xsl:when>
			<xsl:when test="$sayi =  3">Üç Yüz </xsl:when>
			<xsl:when test="$sayi =  4">Dört Yüz </xsl:when>
			<xsl:when test="$sayi =  5">Beş Yüz </xsl:when>
			<xsl:when test="$sayi =  6">Altı Yüz </xsl:when>
			<xsl:when test="$sayi =  7">Yedi Yüz </xsl:when>
			<xsl:when test="$sayi =  8">Sekiz Yüz </xsl:when>
			<xsl:when test="$sayi =  9">Dokuz Yüz </xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="binler_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">Bin </xsl:when>
			<xsl:when test="$sayi =  2">İki Bin </xsl:when>
			<xsl:when test="$sayi =  3">Üç Bin </xsl:when>
			<xsl:when test="$sayi =  4">Dört Bin </xsl:when>
			<xsl:when test="$sayi =  5">Beş Bin </xsl:when>
			<xsl:when test="$sayi =  6">Altı Bin </xsl:when>
			<xsl:when test="$sayi =  7">Yedi Bin </xsl:when>
			<xsl:when test="$sayi =  8">Sekiz Bin </xsl:when>
			<xsl:when test="$sayi =  9">Dokuz Bin </xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="onbinler_oku">
		<xsl:param name="sayi"/>
		<xsl:if test="$sayi &gt; 0">
			<xsl:call-template name="onlar_oku">
				<xsl:with-param name="sayi" select="$sayi"/>
			</xsl:call-template>Bin
		</xsl:if>
	</xsl:template>
	<xsl:template name="parcala">
		<xsl:param name="csv"/>
		<xsl:param name="isaret"/>
		<xsl:variable name="first-item" select="normalize-space(substring-before( concat( $csv, '|'), '|'))"/>
		<xsl:if test="$csv">
			<xsl:if test="normalize-space(substring-after(concat($first-item, ''), $isaret))">
				<xsl:value-of disable-output-escaping="yes" select="normalize-space(substring-after(concat($first-item, ''), $isaret))"/>
			</xsl:if>
			<xsl:call-template name="parcala">
				<xsl:with-param name="csv" select="substring-after($csv,'|')"/>
				<xsl:with-param name="isaret" select="$isaret"/>
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
	<xsl:template match="dateFormatter">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//n1:Invoice/cac:InvoiceLine">
		<tr id="lineTableTr">
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="./cbc:ID"/>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:Item/cac:SellersItemIdentification">
				<td id="lineTableTd">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:value-of select="./cac:Item/cac:SellersItemIdentification/cbc:ID"/>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="./cac:Item/cbc:Name"/>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="format-number(./cbc:InvoicedQuantity, '###.###,####', 'european')"/>
					<xsl:if test="./cbc:InvoicedQuantity/@unitCode">
						<xsl:for-each select="./cbc:InvoicedQuantity">
							<xsl:text>
							</xsl:text>
							<xsl:choose>
								<xsl:when test="@unitCode  = '26'">
									<span>
										<xsl:text>Ton</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'TNE'">
									<span>
										<xsl:text>Ton</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'BX'">
									<span>
										<xsl:text>Kutu</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'LTR'">
									<span>
										<xsl:text>LT</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'C62'">
									<span>
										<xsl:text>Adet</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'DAA'">
									<span>
										<xsl:text>Dekar</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KGM'">
									<span>
										<xsl:text>KG</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'HAR'">
									<span>
										<xsl:text>Hektar</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KJO'">
									<span>
										<xsl:text>kJ</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'GRM'">
									<span>
										<xsl:text>G</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MGM'">
									<span>
										<xsl:text>MG</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'NT'">
									<span>
										<xsl:text>Net Ton</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'GT'">
									<span>
										<xsl:text>GT</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MTR'">
									<span>
										<xsl:text>M</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MMT'">
									<span>
										<xsl:text>MM</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KMT'">
									<span>
										<xsl:text>KM</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MLT'">
									<span>
										<xsl:text>ML</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MMQ'">
									<span>
										<xsl:text>MM3</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CLT'">
									<span>
										<xsl:text>CL</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CMK'">
									<span>
										<xsl:text>CM2</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CMQ'">
									<span>
										<xsl:text>CM3</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CMT'">
									<span>
										<xsl:text>CM</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MTK'">
									<span>
										<xsl:text>M2</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MTQ'">
									<span>
										<xsl:text>M3</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'DAY'">
									<span>
										<xsl:text>Gün</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MON'">
									<span>
										<xsl:text>Ay</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'ANN'">
									<span>
										<xsl:text>Yıl</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'HUR'">
									<span>
										<xsl:text>Saat</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'D61'">
									<span>
										<xsl:text>Dakika</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'D62'">
									<span>
										<xsl:text>Saniye</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'PA'">
									<span>
										<xsl:text>Paket</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'R9'">
									<span>
										<xsl:text>1000 m3</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KWH'">
									<span>
										<xsl:text>KWH</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'GMS'">
									<span>
										<xsl:text>Gümüs</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CTM'">
									<span>
										<xsl:text>Karat</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'ANN'">
									<span>
										<xsl:text>Yıl</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'HUR'">
									<span>
										<xsl:text>Saat</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MIN'">
									<span>
										<xsl:text>Dakika</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'SEC'">
									<span>
										<xsl:text>Saniye</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'LPA'">
									<span>
										<xsl:text>saf alkol lt</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'BG'">
									<span>
										<xsl:text>Torba</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'PR'">
									<span>
										<xsl:text>Adet-Çift</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'DZN'">
									<span>
										<xsl:text>Düzine</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'SET'">
									<span>
										<xsl:text>Set</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'NPL'">
									<span>
										<xsl:text>Koli</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'FTK'">
									<span>
										<xsl:text>Ayak kare</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'FOT'">
									<span>
										<xsl:text>Ayak</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'AFF'">
									<span>
										<xsl:text>AFİF birim fiyatı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'AKQ'">
									<span>
										<xsl:text>ATV Birim Fiyatı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'AYR'">
									<span>
										<xsl:text>Altın ayarı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'B32'">
									<span>
										<xsl:text>KG-METRE kare</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'BAS'">
									<span>
										<xsl:text>Bas</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CCT'">
									<span>
										<xsl:text>Ton başı taşıma</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'D30'">
									<span>
										<xsl:text>Brüt Kalori değeri</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'D40'">
									<span>
										<xsl:text>Bin Litre</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'CEN'">
									<span>
										<xsl:text>Yüz adet</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'T3'">
									<span>
										<xsl:text>Bin adet</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'OTB'">
									<span>
										<xsl:text>OTV birim fiyatı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'OMV'">
									<span>
										<xsl:text>OTV Maktu Vergi</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'D97'">
									<span>
										<xsl:text>Palet</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MLT'">
									<span>
										<xsl:text>Mililitre</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MGM'">
									<span>
										<xsl:text>Miligram</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'GRM'">
									<span>
										<xsl:text>Gram</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KGM'">
									<span>
										<xsl:text>Kilogram</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'GFI'">
									<span>
										<xsl:text>Fıssıle İzotop Gramı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KUR'">
									<span>
										<xsl:text>Uranyum Kilogramı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KSH'">
									<span>
										<xsl:text>Sodyum Hidroksit Kilogramı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KSD'">
									<span>
										<xsl:text>%90 Kuru Ürün Kilogramı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KPR'">
									<span>
										<xsl:text>Kilogram-Çift</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KPH'">
									<span>
										<xsl:text>Kg Potasyum Oksid</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KFO'">
									<span>
										<xsl:text>Difosfor Pentaoksit Kilogramı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'K62'">
									<span>
										<xsl:text>Kilogram-Adet</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'K58'">
									<span>
										<xsl:text>Kurutulmuş Net Ağırlıklı Kilogramı</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'K20'">
									<span>
										<xsl:text>Kilogram Potasyum Oksit</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'LO'">
									<span>
										<xsl:text>Lot</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KMA'">
									<span>
										<xsl:text>METİL AMİNLERİN KİLOGRAMI</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KNI'">
									<span>
										<xsl:text>AZOTUN KİLOGRAMI</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'D32'">
									<span>
										<xsl:text>TERAWATT SAAT</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'GWH'">
									<span>
										<xsl:text>GİGAWATT SAAT</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'MWH'">
									<span>
										<xsl:text>MEGAWATT SAAT </xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'KWT'">
									<span>
										<xsl:text>KİLOWATT </xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'DMK'">
									<span>
										<xsl:text>DESİMETRE KARE</xsl:text>
									</span>
								</xsl:when>
								<xsl:when test="@unitCode  = 'SM3'">
									<span>
										<xsl:text>STANDART METREKÜP</xsl:text>
									</span>
								</xsl:when>
							</xsl:choose>
						</xsl:for-each>
					</xsl:if>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="format-number(./cac:Price/cbc:PriceAmount, '###.##0,########', 'european')"/>
					<xsl:if test="./cac:Price/cbc:PriceAmount/@currencyID">
						<xsl:text> </xsl:text>
						<xsl:if test="./cac:Price/cbc:PriceAmount/@currencyID = &quot;TRL&quot; or ./cac:Price/cbc:PriceAmount/@currencyID = &quot;TRY&quot;">
							<xsl:text>TL</xsl:text>
						</xsl:if>
						<xsl:if test="./cac:Price/cbc:PriceAmount/@currencyID != &quot;TRL&quot; and ./cac:Price/cbc:PriceAmount/@currencyID != &quot;TRY&quot;">
							<xsl:value-of select="./cac:Price/cbc:PriceAmount/@currencyID"/>
						</xsl:if>
					</xsl:if>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:MultiplierFactorNumeric &gt;0">
				<xsl:if test="$iskontoCount &gt; 2">
					<td id="lineTableTd" align="right" width="75">
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:AllowanceCharge/cbc:MultiplierFactorNumeric">
							<xsl:variable name="position" select="position()"/>
							<xsl:value-of select="format-number(. * 100, '###.##0,00', 'european')"/>
							<xsl:if test="$iskontoCount &gt; $position">
								<xsl:text> +</xsl:text>
							</xsl:if>
						</xsl:for-each>
					</td>
				</xsl:if>
				<xsl:if test="$iskontoCount &lt; 2">
					<td id="lineTableTd" align="right">
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:AllowanceCharge/cbc:MultiplierFactorNumeric">
							<xsl:variable name="position" select="position()"/>
							<xsl:value-of select="format-number(. * 100, '###.##0,00', 'european')"/>
							<xsl:if test="$iskontoCount &gt; $position">
								<xsl:text> +</xsl:text>
							</xsl:if>
						</xsl:for-each>
					</td>
				</xsl:if>
				<xsl:if test="$iskontoCount = 2">
					<td id="lineTableTd" align="right" width="100">
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:AllowanceCharge/cbc:MultiplierFactorNumeric">
							<xsl:variable name="position" select="position()"/>
							<xsl:value-of select="format-number(. * 100, '###.##0,00', 'european')"/>
							<xsl:if test="$iskontoCount &gt; $position">
								<xsl:text> +</xsl:text>
							</xsl:if>
						</xsl:for-each>
					</td>
				</xsl:if>
			</xsl:if>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:Amount &gt;0">
				<td align="right">
					<xsl:for-each select="./cac:AllowanceCharge">
						<xsl:if test=".">
							<xsl:value-of select="format-number(./cbc:Amount, '###.##0,00', 'european')"/>
						</xsl:if>
						<xsl:if test="./cbc:Amount/@currencyID">
							<xsl:if test="./cbc:Amount/@currencyID = 'TRY'">
								<xsl:text> TL</xsl:text>
							</xsl:if>
							<xsl:if test="./cbc:Amount/@currencyID != 'TRY'">
								<xsl:value-of select="./cbc:Amount/@currencyID"/>
							</xsl:if>
						</xsl:if>
						<xsl:variable name="position" select="position()"/>
						<xsl:if test="$iskontoCount &gt; $position">
							<xsl:text> +</xsl:text>
						</xsl:if>
					</xsl:for-each>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="./cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
						<xsl:if test="cbc:TaxTypeCode='0015' ">
							<xsl:text>
							</xsl:text>
							<xsl:if test="../../cbc:Percent">
								<xsl:text> %</xsl:text>
								<xsl:value-of select="format-number(../../cbc:Percent, '###.##0,00', 'european')"/>
							</xsl:if>
						</xsl:if>
					</xsl:for-each>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="./cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
						<xsl:if test="cbc:TaxTypeCode='0015' ">
							<xsl:text>
							</xsl:text>
							<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
							<xsl:if test="../../cbc:TaxAmount/@currencyID">
								<xsl:text>
								</xsl:text>
								<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRY'">
									<xsl:text>TL</xsl:text>
								</xsl:if>
								<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRY'">
									<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
								</xsl:if>
							</xsl:if>
						</xsl:if>
					</xsl:for-each>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode!='0015'">
				<td id="lineTableTd" style="font-size: xx-small" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
							<xsl:if test="cbc:TaxTypeCode!='0015' ">
								<xsl:text>
								</xsl:text>
								<xsl:value-of select="cbc:Name"/>
								<xsl:if test="../../cbc:Percent">
									<xsl:text> (%</xsl:text>
									<xsl:value-of select="format-number(../../cbc:Percent, '###.##0,00', 'european')"/>
									<xsl:text>)=</xsl:text>
								</xsl:if>
								<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
								<xsl:if test="../../cbc:TaxAmount/@currencyID">
									<xsl:text>
									</xsl:text>
									<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRY'">
										<xsl:text>TL</xsl:text>
									</xsl:if>
									<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRY'">
										<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
									</xsl:if>
								</xsl:if>
							</xsl:if>
						</xsl:for-each>
						<xsl:for-each select="./cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
							<xsl:text>KDV TEVKİFAT </xsl:text>
							<xsl:if test="../../cbc:Percent">
								<xsl:text> (%</xsl:text>
								<xsl:value-of select="format-number(../../cbc:Percent, '###.##0,00', 'european')"/>
								<xsl:text>)=</xsl:text>
							</xsl:if>
							<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
							<xsl:if test="../../cbc:TaxAmount/@currencyID">
								<xsl:text> </xsl:text>
								<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRL' or ../../cbc:TaxAmount/@currencyID = 'TRY'">
									<xsl:text>TL</xsl:text>
									<xsl:text>&#10;</xsl:text>
								</xsl:if>
								<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRL' and ../../cbc:TaxAmount/@currencyID != 'TRY'">
									<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
									<xsl:text>&#10;</xsl:text>
								</xsl:if>
							</xsl:if>
						</xsl:for-each>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="format-number(./cbc:LineExtensionAmount, '###.##0,00', 'european')"/>
					<xsl:if test="./cbc:LineExtensionAmount/@currencyID">
						<xsl:text>
						</xsl:text>
						<xsl:if test="./cbc:LineExtensionAmount/@currencyID = 'TRY' ">
							<xsl:text>TL</xsl:text>
						</xsl:if>
						<xsl:if test="./cbc:LineExtensionAmount/@currencyID != 'TRY' ">
							<xsl:value-of select="./cbc:LineExtensionAmount/@currencyID"/>
						</xsl:if>
					</xsl:if>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS'">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="cac:Item/cac:AdditionalItemIdentification/cbc:ID[@schemeID='KUNYENO']">
							<xsl:text>&#160;</xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='SATIS') or (//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU')">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="cac:Item/cac:AdditionalItemIdentification/cbc:ID[@schemeID='MALSAHIBIVKNTCKN']">
							<xsl:text>&#160;</xsl:text>
							<xsl:apply-templates/>
							<br/>
						</xsl:for-each>
						<xsl:for-each select="cac:Item/cac:AdditionalItemIdentification/cbc:ID[@schemeID='MALSAHIBIADSOYADUNVAN']">
							<xsl:text>&#160;</xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='IHRACAT'">
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:DeliveryTerms/cbc:ID[@schemeID='INCOTERMS']">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:TransportHandlingUnit/cac:ActualPackage/cbc:PackagingTypeCode">
						<xsl:text>&#160;</xsl:text>
						<xsl:call-template name="Packaging">
							<xsl:with-param name="PackagingType">
								<xsl:value-of select="."/>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:TransportHandlingUnit/cac:ActualPackage/cbc:ID">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:TransportHandlingUnit/cac:ActualPackage/cbc:Quantity">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:DeliveryAddress">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:ShipmentStage/cbc:TransportModeCode">
						<xsl:text>&#160;</xsl:text>
						<xsl:call-template name="TransportMode">
							<xsl:with-param name="TransportModeType">
								<xsl:value-of select="."/>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:GoodsItem/cbc:RequiredCustomsID">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
			</xsl:if>
		</tr>
	</xsl:template>
	<xsl:template match="//n1:Invoice">
		<tr id="lineTableTr">
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:Item/cac:SellersItemIdentification">
				<td id="lineTableTd">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:MultiplierFactorNumeric &gt;0">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:Amount &gt;0">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode!='0015'">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS'">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='SATIS') or (//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU')">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<br/>
					</span>
				</td>
				<!-- <td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td> -->
			</xsl:if>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='IHRACAT'">
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
			</xsl:if>
		</tr>
	</xsl:template>
	<xsl:template name="Party_Title">
		<xsl:param name="PartyType"/>
		<td style="width:469px; " align="left">
			<xsl:if test="cac:PartyName">
				<xsl:value-of select="cac:PartyName/cbc:Name"/>
				<br/>
			</xsl:if>
			<xsl:for-each select="cac:Person">
				<xsl:for-each select="cbc:Title">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:FirstName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:MiddleName">
					<xsl:apply-templates/>
					<xsl:text>&#160; </xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:FamilyName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:NameSuffix">
					<xsl:apply-templates/>
				</xsl:for-each>
				<xsl:if test="$PartyType='TAXFREE'">
					<br/>
					<xsl:text>Pasaport No: </xsl:text>
					<xsl:value-of select="cac:IdentityDocumentReference/cbc:ID"/>
					<br/>
					<xsl:text>Ülkesi: </xsl:text>
					<xsl:for-each select="cbc:NationalityID">
						<xsl:call-template name="Country">
							<xsl:with-param name="CountryType">
								<xsl:value-of select="."/>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:for-each>
				</xsl:if>
			</xsl:for-each>
		</td>
	</xsl:template>
	<xsl:template name="Party_Adress">
		<xsl:param name="PartyType"/>
		<td style="width:469px; " align="left">
			<xsl:for-each select="cac:PostalAddress">
				<xsl:for-each select="cbc:StreetName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:BuildingName">
					<xsl:apply-templates/>
				</xsl:for-each>
				<xsl:for-each select="cbc:BuildingNumber">
					<xsl:text> No:</xsl:text>
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<br/>
				<xsl:for-each select="cbc:Room">
					<xsl:text>Kapı No:</xsl:text>
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<br/>
				<xsl:for-each select="cbc:PostalZone">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:CitySubdivisionName">
					<xsl:apply-templates/>
					<xsl:text>/ </xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:CityName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:if test="$PartyType!='OTHER'">
					<br/>
					<xsl:value-of select="cac:Country/cbc:Name"/>
					<br/>
				</xsl:if>
			</xsl:for-each>
		</td>
	</xsl:template>
	<xsl:template name="TransportMode">
		<xsl:param name="TransportModeType"/>
		<xsl:choose>
			<xsl:when test="$TransportModeType=1">Denizyolu</xsl:when>
			<xsl:when test="$TransportModeType=2">Demiryolu</xsl:when>
			<xsl:when test="$TransportModeType=3">Karayolu</xsl:when>
			<xsl:when test="$TransportModeType=4">Havayolu</xsl:when>
			<xsl:when test="$TransportModeType=5">Posta</xsl:when>
			<xsl:when test="$TransportModeType=6">Çok araçlı</xsl:when>
			<xsl:when test="$TransportModeType=7">Sabit taşıma tesisleri</xsl:when>
			<xsl:when test="$TransportModeType=8">İç su taşımacılığı</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$TransportModeType"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="Packaging">
		<xsl:param name="PackagingType"/>
		<xsl:choose>
			<xsl:when test="$PackagingType='1A'">Drum, steel</xsl:when>
			<xsl:when test="$PackagingType='1B'">Drum, aluminium</xsl:when>
			<xsl:when test="$PackagingType='1D'">Drum, plywood</xsl:when>
			<xsl:when test="$PackagingType='1F'">Container, flexible</xsl:when>
			<xsl:when test="$PackagingType='1G'">Drum, fibre</xsl:when>
			<xsl:when test="$PackagingType='1W'">Drum, wooden</xsl:when>
			<xsl:when test="$PackagingType='2C'">Barrel, wooden</xsl:when>
			<xsl:when test="$PackagingType='3A'">Jerrican, steel</xsl:when>
			<xsl:when test="$PackagingType='3H'">Jerrican, plastic</xsl:when>
			<xsl:when test="$PackagingType='43'">Bag, super bulk</xsl:when>
			<xsl:when test="$PackagingType='44'">Bag, polybag</xsl:when>
			<xsl:when test="$PackagingType='4A'">Box, steel</xsl:when>
			<xsl:when test="$PackagingType='4B'">Box, aluminium</xsl:when>
			<xsl:when test="$PackagingType='4C'">Box, natural wood</xsl:when>
			<xsl:when test="$PackagingType='4D'">Box, plywood</xsl:when>
			<xsl:when test="$PackagingType='4F'">Box, reconstituted wood</xsl:when>
			<xsl:when test="$PackagingType='4G'">Box, fibreboard</xsl:when>
			<xsl:when test="$PackagingType='4H'">Box, plastic</xsl:when>
			<xsl:when test="$PackagingType='5H'">Bag, woven plastic</xsl:when>
			<xsl:when test="$PackagingType='5L'">Bag, textile</xsl:when>
			<xsl:when test="$PackagingType='5M'">Bag, paper</xsl:when>
			<xsl:when test="$PackagingType='6H'">Composite packaging, plastic receptacle</xsl:when>
			<xsl:when test="$PackagingType='6P'">Composite packaging, glass receptacle</xsl:when>
			<xsl:when test="$PackagingType='7A'">Case, car</xsl:when>
			<xsl:when test="$PackagingType='7B'">Case, wooden</xsl:when>
			<xsl:when test="$PackagingType='8A'">Pallet, wooden</xsl:when>
			<xsl:when test="$PackagingType='8B'">Crate, wooden</xsl:when>
			<xsl:when test="$PackagingType='8C'">Bundle, wooden</xsl:when>
			<xsl:when test="$PackagingType='AA'">Intermediate bulk container, rigid plastic</xsl:when>
			<xsl:when test="$PackagingType='AB'">Receptacle, fibre</xsl:when>
			<xsl:when test="$PackagingType='AC'">Receptacle, paper</xsl:when>
			<xsl:when test="$PackagingType='AD'">Receptacle, wooden</xsl:when>
			<xsl:when test="$PackagingType='AE'">Aerosol</xsl:when>
			<xsl:when test="$PackagingType='AF'">Pallet, modular, collars 80cms * 60cms</xsl:when>
			<xsl:when test="$PackagingType='AG'">Pallet, shrinkwrapped</xsl:when>
			<xsl:when test="$PackagingType='AH'">Pallet, 100cms * 110cms</xsl:when>
			<xsl:when test="$PackagingType='AI'">Clamshell</xsl:when>
			<xsl:when test="$PackagingType='AJ'">Cone</xsl:when>
			<xsl:when test="$PackagingType='AL'">Ball</xsl:when>
			<xsl:when test="$PackagingType='AM'">Ampoule, non-protected</xsl:when>
			<xsl:when test="$PackagingType='AP'">Ampoule, protected</xsl:when>
			<xsl:when test="$PackagingType='AT'">Atomizer</xsl:when>
			<xsl:when test="$PackagingType='AV'">Capsule</xsl:when>
			<xsl:when test="$PackagingType='B4'">Belt</xsl:when>
			<xsl:when test="$PackagingType='BA'">Barrel</xsl:when>
			<xsl:when test="$PackagingType='BB'">Bobbin</xsl:when>
			<xsl:when test="$PackagingType='BC'">Bottlecrate / bottlerack</xsl:when>
			<xsl:when test="$PackagingType='BD'">Board</xsl:when>
			<xsl:when test="$PackagingType='BE'">Bundle</xsl:when>
			<xsl:when test="$PackagingType='BF'">Balloon, non-protected</xsl:when>
			<xsl:when test="$PackagingType='BG'">Bag</xsl:when>
			<xsl:when test="$PackagingType='BH'">Bunch</xsl:when>
			<xsl:when test="$PackagingType='BI'">Bin</xsl:when>
			<xsl:when test="$PackagingType='BJ'">Bucket</xsl:when>
			<xsl:when test="$PackagingType='BK'">Basket</xsl:when>
			<xsl:when test="$PackagingType='BL'">Bale, compressed</xsl:when>
			<xsl:when test="$PackagingType='BM'">Basin</xsl:when>
			<xsl:when test="$PackagingType='BN'">Bale, non-compressed</xsl:when>
			<xsl:when test="$PackagingType='BO'">Bottle, non-protected, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='BP'">Balloon, protected</xsl:when>
			<xsl:when test="$PackagingType='BQ'">Bottle, protected cylindrical</xsl:when>
			<xsl:when test="$PackagingType='BR'">Bar</xsl:when>
			<xsl:when test="$PackagingType='BS'">Bottle, non-protected, bulbous</xsl:when>
			<xsl:when test="$PackagingType='BT'">Bolt</xsl:when>
			<xsl:when test="$PackagingType='BU'">Butt</xsl:when>
			<xsl:when test="$PackagingType='BV'">Bottle, protected bulbous</xsl:when>
			<xsl:when test="$PackagingType='BW'">Box, for liquids</xsl:when>
			<xsl:when test="$PackagingType='BX'">Box</xsl:when>
			<xsl:when test="$PackagingType='BY'">Board, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='BZ'">Bars, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='CA'">Can, rectangular</xsl:when>
			<xsl:when test="$PackagingType='CB'">Crate, beer</xsl:when>
			<xsl:when test="$PackagingType='CC'">Churn</xsl:when>
			<xsl:when test="$PackagingType='CD'">Can, with handle and spout</xsl:when>
			<xsl:when test="$PackagingType='CE'">Creel</xsl:when>
			<xsl:when test="$PackagingType='CF'">Coffer</xsl:when>
			<xsl:when test="$PackagingType='CG'">Cage</xsl:when>
			<xsl:when test="$PackagingType='CH'">Chest</xsl:when>
			<xsl:when test="$PackagingType='CI'">Canister</xsl:when>
			<xsl:when test="$PackagingType='CJ'">Coffin</xsl:when>
			<xsl:when test="$PackagingType='CK'">Cask</xsl:when>
			<xsl:when test="$PackagingType='CL'">Coil</xsl:when>
			<xsl:when test="$PackagingType='CM'">Card</xsl:when>
			<xsl:when test="$PackagingType='CN'">Container, not otherwise specified as transport equipment</xsl:when>
			<xsl:when test="$PackagingType='CO'">Carboy, non-protected</xsl:when>
			<xsl:when test="$PackagingType='CP'">Carboy, protected</xsl:when>
			<xsl:when test="$PackagingType='CQ'">Cartridge</xsl:when>
			<xsl:when test="$PackagingType='CR'">Crate</xsl:when>
			<xsl:when test="$PackagingType='CS'">Case</xsl:when>
			<xsl:when test="$PackagingType='CT'">Carton</xsl:when>
			<xsl:when test="$PackagingType='CU'">Cup</xsl:when>
			<xsl:when test="$PackagingType='CV'">Cover</xsl:when>
			<xsl:when test="$PackagingType='CW'">Cage, roll</xsl:when>
			<xsl:when test="$PackagingType='CX'">Can, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='CY'">Cylinder</xsl:when>
			<xsl:when test="$PackagingType='CZ'">Canvas</xsl:when>
			<xsl:when test="$PackagingType='DA'">Crate, multiple layer, plastic</xsl:when>
			<xsl:when test="$PackagingType='DB'">Crate, multiple layer, wooden</xsl:when>
			<xsl:when test="$PackagingType='DC'">Crate, multiple layer, cardboard</xsl:when>
			<xsl:when test="$PackagingType='DG'">Cage, Commonwealth Handling Equipment Pool (CHEP)</xsl:when>
			<xsl:when test="$PackagingType='DH'">Box, Commonwealth Handling Equipment Pool (CHEP), Eurobox</xsl:when>
			<xsl:when test="$PackagingType='DI'">Drum, iron</xsl:when>
			<xsl:when test="$PackagingType='DJ'">Demijohn, non-protected</xsl:when>
			<xsl:when test="$PackagingType='DK'">Crate, bulk, cardboard</xsl:when>
			<xsl:when test="$PackagingType='DL'">Crate, bulk, plastic</xsl:when>
			<xsl:when test="$PackagingType='DM'">Crate, bulk, wooden</xsl:when>
			<xsl:when test="$PackagingType='DN'">Dispenser</xsl:when>
			<xsl:when test="$PackagingType='DP'">Demijohn, protected</xsl:when>
			<xsl:when test="$PackagingType='DR'">Drum</xsl:when>
			<xsl:when test="$PackagingType='DS'">Tray, one layer no cover, plastic</xsl:when>
			<xsl:when test="$PackagingType='DT'">Tray, one layer no cover, wooden</xsl:when>
			<xsl:when test="$PackagingType='DU'">Tray, one layer no cover, polystyrene</xsl:when>
			<xsl:when test="$PackagingType='DV'">Tray, one layer no cover, cardboard</xsl:when>
			<xsl:when test="$PackagingType='DW'">Tray, two layers no cover, plastic tray</xsl:when>
			<xsl:when test="$PackagingType='DX'">Tray, two layers no cover, wooden</xsl:when>
			<xsl:when test="$PackagingType='DY'">Tray, two layers no cover, cardboard</xsl:when>
			<xsl:when test="$PackagingType='EC'">Bag, plastic</xsl:when>
			<xsl:when test="$PackagingType='ED'">Case, with pallet base</xsl:when>
			<xsl:when test="$PackagingType='EE'">Case, with pallet base, wooden</xsl:when>
			<xsl:when test="$PackagingType='EF'">Case, with pallet base, cardboard</xsl:when>
			<xsl:when test="$PackagingType='EG'">Case, with pallet base, plastic</xsl:when>
			<xsl:when test="$PackagingType='EH'">Case, with pallet base, metal</xsl:when>
			<xsl:when test="$PackagingType='EI'">Case, isothermic</xsl:when>
			<xsl:when test="$PackagingType='EN'">Envelope</xsl:when>
			<xsl:when test="$PackagingType='FB'">Flexibag</xsl:when>
			<xsl:when test="$PackagingType='FC'">Crate, fruit</xsl:when>
			<xsl:when test="$PackagingType='FD'">Crate, framed</xsl:when>
			<xsl:when test="$PackagingType='FE'">Flexitank</xsl:when>
			<xsl:when test="$PackagingType='FI'">Firkin</xsl:when>
			<xsl:when test="$PackagingType='FL'">Flask</xsl:when>
			<xsl:when test="$PackagingType='FO'">Footlocker</xsl:when>
			<xsl:when test="$PackagingType='FP'">Filmpack</xsl:when>
			<xsl:when test="$PackagingType='FR'">Frame</xsl:when>
			<xsl:when test="$PackagingType='FT'">Foodtainer</xsl:when>
			<xsl:when test="$PackagingType='FW'">Cart, flatbed</xsl:when>
			<xsl:when test="$PackagingType='FX'">Bag, flexible container</xsl:when>
			<xsl:when test="$PackagingType='GB'">Bottle, gas</xsl:when>
			<xsl:when test="$PackagingType='GI'">Girder</xsl:when>
			<xsl:when test="$PackagingType='GL'">Container, gallon</xsl:when>
			<xsl:when test="$PackagingType='GR'">Receptacle, glass</xsl:when>
			<xsl:when test="$PackagingType='GU'">Tray, containing horizontally stacked flat items</xsl:when>
			<xsl:when test="$PackagingType='GY'">Bag, gunny</xsl:when>
			<xsl:when test="$PackagingType='GZ'">Girders, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='HA'">Basket, with handle, plastic</xsl:when>
			<xsl:when test="$PackagingType='HB'">Basket, with handle, wooden</xsl:when>
			<xsl:when test="$PackagingType='HC'">Basket, with handle, cardboard</xsl:when>
			<xsl:when test="$PackagingType='HG'">Hogshead</xsl:when>
			<xsl:when test="$PackagingType='HN'">Hanger</xsl:when>
			<xsl:when test="$PackagingType='HR'">Hamper</xsl:when>
			<xsl:when test="$PackagingType='IA'">Package, display, wooden</xsl:when>
			<xsl:when test="$PackagingType='IB'">Package, display, cardboard</xsl:when>
			<xsl:when test="$PackagingType='IC'">Package, display, plastic</xsl:when>
			<xsl:when test="$PackagingType='ID'">Package, display, metal</xsl:when>
			<xsl:when test="$PackagingType='IE'">Package, show</xsl:when>
			<xsl:when test="$PackagingType='IF'">Package, flow</xsl:when>
			<xsl:when test="$PackagingType='IG'">Package, paper wrapped</xsl:when>
			<xsl:when test="$PackagingType='IH'">Drum, plastic</xsl:when>
			<xsl:when test="$PackagingType='IK'">Package, cardboard, with bottle grip-holes</xsl:when>
			<xsl:when test="$PackagingType='IL'">Tray, rigid, lidded stackable (CEN TS 14482:2002)</xsl:when>
			<xsl:when test="$PackagingType='IN'">Ingot</xsl:when>
			<xsl:when test="$PackagingType='IZ'">Ingots, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='JB'">Bag, jumbo</xsl:when>
			<xsl:when test="$PackagingType='JC'">Jerrican, rectangular</xsl:when>
			<xsl:when test="$PackagingType='JG'">Jug</xsl:when>
			<xsl:when test="$PackagingType='JR'">Jar</xsl:when>
			<xsl:when test="$PackagingType='JT'">Jutebag</xsl:when>
			<xsl:when test="$PackagingType='JY'">Jerrican, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='KG'">Keg</xsl:when>
			<xsl:when test="$PackagingType='KI'">Kit</xsl:when>
			<xsl:when test="$PackagingType='LE'">Luggage</xsl:when>
			<xsl:when test="$PackagingType='LG'">Log</xsl:when>
			<xsl:when test="$PackagingType='LT'">Lot</xsl:when>
			<xsl:when test="$PackagingType='LU'">Lug</xsl:when>
			<xsl:when test="$PackagingType='LV'">Liftvan</xsl:when>
			<xsl:when test="$PackagingType='LZ'">Logs, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='MA'">Crate, metal</xsl:when>
			<xsl:when test="$PackagingType='MB'">Bag, multiply</xsl:when>
			<xsl:when test="$PackagingType='MC'">Crate, milk</xsl:when>
			<xsl:when test="$PackagingType='ME'">Container, metal</xsl:when>
			<xsl:when test="$PackagingType='MR'">Receptacle, metal</xsl:when>
			<xsl:when test="$PackagingType='MS'">Sack, multi-wall</xsl:when>
			<xsl:when test="$PackagingType='MT'">Mat</xsl:when>
			<xsl:when test="$PackagingType='MW'">Receptacle, plastic wrapped</xsl:when>
			<xsl:when test="$PackagingType='MX'">Matchbox</xsl:when>
			<xsl:when test="$PackagingType='NA'">Not available</xsl:when>
			<xsl:when test="$PackagingType='NE'">Unpacked or unpackaged</xsl:when>
			<xsl:when test="$PackagingType='NF'">Unpacked or unpackaged, single unit</xsl:when>
			<xsl:when test="$PackagingType='NG'">Unpacked or unpackaged, multiple units</xsl:when>
			<xsl:when test="$PackagingType='NS'">Nest</xsl:when>
			<xsl:when test="$PackagingType='NT'">Net</xsl:when>
			<xsl:when test="$PackagingType='NU'">Net, tube, plastic</xsl:when>
			<xsl:when test="$PackagingType='NV'">Net, tube, textile</xsl:when>
			<xsl:when test="$PackagingType='OA'">Pallet, CHEP 40 cm x 60 cm</xsl:when>
			<xsl:when test="$PackagingType='OB'">Pallet, CHEP 80 cm x 120 cm</xsl:when>
			<xsl:when test="$PackagingType='OC'">Pallet, CHEP 100 cm x 120 cm</xsl:when>
			<xsl:when test="$PackagingType='OD'">Pallet, AS 4068-1993</xsl:when>
			<xsl:when test="$PackagingType='OE'">Pallet, ISO T11</xsl:when>
			<xsl:when test="$PackagingType='OF'">Platform, unspecified weight or dimension</xsl:when>
			<xsl:when test="$PackagingType='OK'">Block</xsl:when>
			<xsl:when test="$PackagingType='OT'">Octabin</xsl:when>
			<xsl:when test="$PackagingType='OU'">Container, outer</xsl:when>
			<xsl:when test="$PackagingType='P2'">Pan</xsl:when>
			<xsl:when test="$PackagingType='PA'">Packet</xsl:when>
			<xsl:when test="$PackagingType='PB'">Pallet, box Combined open-ended box and pallet</xsl:when>
			<xsl:when test="$PackagingType='PC'">Parcel</xsl:when>
			<xsl:when test="$PackagingType='PD'">Pallet, modular, collars 80cms * 100cms</xsl:when>
			<xsl:when test="$PackagingType='PE'">Pallet, modular, collars 80cms * 120cms</xsl:when>
			<xsl:when test="$PackagingType='PF'">Pen</xsl:when>
			<xsl:when test="$PackagingType='PG'">Plate</xsl:when>
			<xsl:when test="$PackagingType='PH'">Pitcher</xsl:when>
			<xsl:when test="$PackagingType='PI'">Pipe</xsl:when>
			<xsl:when test="$PackagingType='PJ'">Punnet</xsl:when>
			<xsl:when test="$PackagingType='PK'">Package</xsl:when>
			<xsl:when test="$PackagingType='PL'">Pail</xsl:when>
			<xsl:when test="$PackagingType='PN'">Plank</xsl:when>
			<xsl:when test="$PackagingType='PO'">Pouch</xsl:when>
			<xsl:when test="$PackagingType='PP'">Piece</xsl:when>
			<xsl:when test="$PackagingType='PR'">Receptacle, plastic</xsl:when>
			<xsl:when test="$PackagingType='PT'">Pot</xsl:when>
			<xsl:when test="$PackagingType='PU'">Tray</xsl:when>
			<xsl:when test="$PackagingType='PV'">Pipes, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='PX'">Pallet</xsl:when>
			<xsl:when test="$PackagingType='PY'">Plates, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='PZ'">Planks, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='QA'">Drum, steel, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QB'">Drum, steel, removable head</xsl:when>
			<xsl:when test="$PackagingType='QC'">Drum, aluminium, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QD'">Drum, aluminium, removable head</xsl:when>
			<xsl:when test="$PackagingType='QF'">Drum, plastic, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QG'">Drum, plastic, removable head</xsl:when>
			<xsl:when test="$PackagingType='QH'">Barrel, wooden, bung type</xsl:when>
			<xsl:when test="$PackagingType='QJ'">Barrel, wooden, removable head</xsl:when>
			<xsl:when test="$PackagingType='QK'">Jerrican, steel, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QL'">Jerrican, steel, removable head</xsl:when>
			<xsl:when test="$PackagingType='QM'">Jerrican, plastic, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QN'">Jerrican, plastic, removable head</xsl:when>
			<xsl:when test="$PackagingType='QP'">Box, wooden, natural wood, ordinary</xsl:when>
			<xsl:when test="$PackagingType='QQ'">Box, wooden, natural wood, with sift proof walls</xsl:when>
			<xsl:when test="$PackagingType='QR'">Box, plastic, expanded</xsl:when>
			<xsl:when test="$PackagingType='QS'">Box, plastic, solid</xsl:when>
			<xsl:when test="$PackagingType='RD'">Rod</xsl:when>
			<xsl:when test="$PackagingType='RG'">Ring</xsl:when>
			<xsl:when test="$PackagingType='RJ'">Rack, clothing hanger</xsl:when>
			<xsl:when test="$PackagingType='RK'">Rack</xsl:when>
			<xsl:when test="$PackagingType='RL'">Reel</xsl:when>
			<xsl:when test="$PackagingType='RO'">Roll</xsl:when>
			<xsl:when test="$PackagingType='RT'">Rednet</xsl:when>
			<xsl:when test="$PackagingType='RZ'">Rods, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='SA'">Sack</xsl:when>
			<xsl:when test="$PackagingType='SB'">Slab</xsl:when>
			<xsl:when test="$PackagingType='SC'">Crate, shallow</xsl:when>
			<xsl:when test="$PackagingType='SD'">Spindle</xsl:when>
			<xsl:when test="$PackagingType='SE'">Sea-chest</xsl:when>
			<xsl:when test="$PackagingType='SH'">Sachet</xsl:when>
			<xsl:when test="$PackagingType='SI'">Skid</xsl:when>
			<xsl:when test="$PackagingType='SK'">Case, skeleton</xsl:when>
			<xsl:when test="$PackagingType='SL'">Slipsheet</xsl:when>
			<xsl:when test="$PackagingType='SM'">Sheetmetal</xsl:when>
			<xsl:when test="$PackagingType='SO'">Spool</xsl:when>
			<xsl:when test="$PackagingType='SP'">Sheet, plastic wrapping</xsl:when>
			<xsl:when test="$PackagingType='SS'">Case, steel</xsl:when>
			<xsl:when test="$PackagingType='ST'">Sheet</xsl:when>
			<xsl:when test="$PackagingType='SU'">Suitcase</xsl:when>
			<xsl:when test="$PackagingType='SV'">Envelope, steel</xsl:when>
			<xsl:when test="$PackagingType='SW'">Shrinkwrapped</xsl:when>
			<xsl:when test="$PackagingType='SX'">Set</xsl:when>
			<xsl:when test="$PackagingType='SY'">Sleeve</xsl:when>
			<xsl:when test="$PackagingType='SZ'">Sheets, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='T1'">Tablet</xsl:when>
			<xsl:when test="$PackagingType='TB'">Tub</xsl:when>
			<xsl:when test="$PackagingType='TC'">Tea-chest</xsl:when>
			<xsl:when test="$PackagingType='TD'">Tube, collapsible</xsl:when>
			<xsl:when test="$PackagingType='TE'">Tyre</xsl:when>
			<xsl:when test="$PackagingType='TG'">Tank container, generic</xsl:when>
			<xsl:when test="$PackagingType='TI'">Tierce</xsl:when>
			<xsl:when test="$PackagingType='TK'">Tank, rectangular</xsl:when>
			<xsl:when test="$PackagingType='TL'">Tub, with lid</xsl:when>
			<xsl:when test="$PackagingType='TN'">Tin</xsl:when>
			<xsl:when test="$PackagingType='TO'">Tun</xsl:when>
			<xsl:when test="$PackagingType='TR'">Trunk</xsl:when>
			<xsl:when test="$PackagingType='TS'">Truss</xsl:when>
			<xsl:when test="$PackagingType='TT'">Bag, tote</xsl:when>
			<xsl:when test="$PackagingType='TU'">Tube</xsl:when>
			<xsl:when test="$PackagingType='TV'">Tube, with nozzle</xsl:when>
			<xsl:when test="$PackagingType='TW'">Pallet, triwall</xsl:when>
			<xsl:when test="$PackagingType='TY'">Tank, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='TZ'">Tubes, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='UC'">Uncaged</xsl:when>
			<xsl:when test="$PackagingType='UN'">Unit</xsl:when>
			<xsl:when test="$PackagingType='VA'">Vat</xsl:when>
			<xsl:when test="$PackagingType='VG'">Bulk, gas (at 1031 mbar and 15Â°C)</xsl:when>
			<xsl:when test="$PackagingType='VI'">Vial</xsl:when>
			<xsl:when test="$PackagingType='VK'">Vanpack</xsl:when>
			<xsl:when test="$PackagingType='VL'">Bulk, liquid</xsl:when>
			<xsl:when test="$PackagingType='VO'">Bulk, solid, large particles (Â“nodulesÂ”)</xsl:when>
			<xsl:when test="$PackagingType='VP'">Vacuum-packed</xsl:when>
			<xsl:when test="$PackagingType='VQ'">Bulk, liquefied gas (at abnormal temperature/pressure)</xsl:when>
			<xsl:when test="$PackagingType='VN'">Vehicle</xsl:when>
			<xsl:when test="$PackagingType='VR'">Bulk, solid, granular particles (Â“grainsÂ”)</xsl:when>
			<xsl:when test="$PackagingType='VS'">Bulk, scrap metal</xsl:when>
			<xsl:when test="$PackagingType='VY'">Bulk, solid, fine particles (Â“powdersÂ”)</xsl:when>
			<xsl:when test="$PackagingType='WA'">Intermediate bulk container</xsl:when>
			<xsl:when test="$PackagingType='WB'">Wickerbottle</xsl:when>
			<xsl:when test="$PackagingType='WC'">Intermediate bulk container, steel</xsl:when>
			<xsl:when test="$PackagingType='WD'">Intermediate bulk container, aluminium</xsl:when>
			<xsl:when test="$PackagingType='WF'">Intermediate bulk container, metal</xsl:when>
			<xsl:when test="$PackagingType='WG'">Intermediate bulk container, steel, pressurised > 10 kpa</xsl:when>
			<xsl:when test="$PackagingType='WH'">Intermediate bulk container, aluminium, pressurised > 10 kpa</xsl:when>
			<xsl:when test="$PackagingType='WJ'">Intermediate bulk container, metal, pressure 10 kpa</xsl:when>
			<xsl:when test="$PackagingType='WK'">Intermediate bulk container, steel, liquid</xsl:when>
			<xsl:when test="$PackagingType='WL'">Intermediate bulk container, aluminium, liquid</xsl:when>
			<xsl:when test="$PackagingType='WM'">Intermediate bulk container, metal, liquid</xsl:when>
			<xsl:when test="$PackagingType='WN'">Intermediate bulk container, woven plastic, without coat/liner</xsl:when>
			<xsl:when test="$PackagingType='WP'">Intermediate bulk container, woven plastic, coated</xsl:when>
			<xsl:when test="$PackagingType='WQ'">Intermediate bulk container, woven plastic, with liner</xsl:when>
			<xsl:when test="$PackagingType='WR'">Intermediate bulk container, woven plastic, coated and liner</xsl:when>
			<xsl:when test="$PackagingType='WS'">Intermediate bulk container, plastic film</xsl:when>
			<xsl:when test="$PackagingType='WT'">Intermediate bulk container, textile with out coat/liner</xsl:when>
			<xsl:when test="$PackagingType='WU'">Intermediate bulk container, natural wood, with inner liner</xsl:when>
			<xsl:when test="$PackagingType='WV'">Intermediate bulk container, textile, coated</xsl:when>
			<xsl:when test="$PackagingType='WW'">Intermediate bulk container, textile, with liner</xsl:when>
			<xsl:when test="$PackagingType='WX'">Intermediate bulk container, textile, coated and liner</xsl:when>
			<xsl:when test="$PackagingType='WY'">Intermediate bulk container, plywood, with inner liner</xsl:when>
			<xsl:when test="$PackagingType='WZ'">Intermediate bulk container, reconstituted wood, with inner liner</xsl:when>
			<xsl:when test="$PackagingType='XA'">Bag, woven plastic, without inner coat/liner</xsl:when>
			<xsl:when test="$PackagingType='XB'">Bag, woven plastic, sift proof</xsl:when>
			<xsl:when test="$PackagingType='XC'">Bag, woven plastic, water resistant</xsl:when>
			<xsl:when test="$PackagingType='XD'">Bag, plastics film</xsl:when>
			<xsl:when test="$PackagingType='XF'">Bag, textile, without inner coat/liner</xsl:when>
			<xsl:when test="$PackagingType='XG'">Bag, textile, sift proof</xsl:when>
			<xsl:when test="$PackagingType='XH'">Bag, textile, water resistant</xsl:when>
			<xsl:when test="$PackagingType='XJ'">Bag, paper, multi-wall</xsl:when>
			<xsl:when test="$PackagingType='XK'">Bag, paper, multi-wall, water resistant</xsl:when>
			<xsl:when test="$PackagingType='YA'">Composite packaging, plastic receptacle in steel drum</xsl:when>
			<xsl:when test="$PackagingType='YB'">Composite packaging, plastic receptacle in steel crate box</xsl:when>
			<xsl:when test="$PackagingType='YC'">Composite packaging, plastic receptacle in aluminium drum</xsl:when>
			<xsl:when test="$PackagingType='YD'">Composite packaging, plastic receptacle in aluminium crate</xsl:when>
			<xsl:when test="$PackagingType='YF'">Composite packaging, plastic receptacle in wooden box</xsl:when>
			<xsl:when test="$PackagingType='YG'">Composite packaging, plastic receptacle in plywood drum</xsl:when>
			<xsl:when test="$PackagingType='YH'">Composite packaging, plastic receptacle in plywood box</xsl:when>
			<xsl:when test="$PackagingType='YJ'">Composite packaging, plastic receptacle in fibre drum</xsl:when>
			<xsl:when test="$PackagingType='YK'">Composite packaging, plastic receptacle in fibreboard box</xsl:when>
			<xsl:when test="$PackagingType='YL'">Composite packaging, plastic receptacle in plastic drum</xsl:when>
			<xsl:when test="$PackagingType='YM'">Composite packaging, plastic receptacle in solid plastic box</xsl:when>
			<xsl:when test="$PackagingType='YN'">Composite packaging, glass receptacle in steel drum</xsl:when>
			<xsl:when test="$PackagingType='YP'">Composite packaging, glass receptacle in steel crate box</xsl:when>
			<xsl:when test="$PackagingType='YQ'">Composite packaging, glass receptacle in aluminium drum</xsl:when>
			<xsl:when test="$PackagingType='YR'">Composite packaging, glass receptacle in aluminium crate</xsl:when>
			<xsl:when test="$PackagingType='YS'">Composite packaging, glass receptacle in wooden box</xsl:when>
			<xsl:when test="$PackagingType='YT'">Composite packaging, glass receptacle in plywood drum</xsl:when>
			<xsl:when test="$PackagingType='YV'">Composite packaging, glass receptacle in wickerwork hamper</xsl:when>
			<xsl:when test="$PackagingType='YW'">Composite packaging, glass receptacle in fibre drum</xsl:when>
			<xsl:when test="$PackagingType='YX'">Composite packaging, glass receptacle in fibreboard box</xsl:when>
			<xsl:when test="$PackagingType='YY'">Composite packaging, glass receptacle in expandable plastic pack</xsl:when>
			<xsl:when test="$PackagingType='YZ'">Composite packaging, glass receptacle in solid plastic pack</xsl:when>
			<xsl:when test="$PackagingType='ZA'">Intermediate bulk container, paper, multi-wall</xsl:when>
			<xsl:when test="$PackagingType='ZB'">Bag, large</xsl:when>
			<xsl:when test="$PackagingType='ZC'">Intermediate bulk container, paper, multi-wall, water resistant</xsl:when>
			<xsl:when test="$PackagingType='ZD'">Intermediate bulk container, rigid plastic, with structural equipment, solids</xsl:when>
			<xsl:when test="$PackagingType='ZF'">Intermediate bulk container, rigid plastic, freestanding, solids</xsl:when>
			<xsl:when test="$PackagingType='ZG'">Intermediate bulk container, rigid plastic, with structural equipment, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZH'">Intermediate bulk container, rigid plastic, freestanding, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZJ'">Intermediate bulk container, rigid plastic, with structural equipment, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZK'">Intermediate bulk container, rigid plastic, freestanding, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZL'">Intermediate bulk container, composite, rigid plastic, solids</xsl:when>
			<xsl:when test="$PackagingType='ZM'">Intermediate bulk container, composite, flexible plastic, solids</xsl:when>
			<xsl:when test="$PackagingType='ZN'">Intermediate bulk container, composite, rigid plastic, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZP'">Intermediate bulk container, composite, flexible plastic, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZQ'">Intermediate bulk container, composite, rigid plastic, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZR'">Intermediate bulk container, composite, flexible plastic, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZS'">Intermediate bulk container, composite</xsl:when>
			<xsl:when test="$PackagingType='ZT'">Intermediate bulk container, fibreboard</xsl:when>
			<xsl:when test="$PackagingType='ZU'">Intermediate bulk container, flexible</xsl:when>
			<xsl:when test="$PackagingType='ZV'">Intermediate bulk container, metal, other than steel</xsl:when>
			<xsl:when test="$PackagingType='ZW'">Intermediate bulk container, natural wood</xsl:when>
			<xsl:when test="$PackagingType='ZX'">Intermediate bulk container, plywood</xsl:when>
			<xsl:when test="$PackagingType='ZY'">Intermediate bulk container, reconstituted wood</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$PackagingType"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="Country">
		<xsl:param name="CountryType"/>
		<xsl:choose>
			<xsl:when test="$CountryType='AF'">Afganistan</xsl:when>
			<xsl:when test="$CountryType='DE'">Almanya</xsl:when>
			<xsl:when test="$CountryType='AD'">Andorra</xsl:when>
			<xsl:when test="$CountryType='AO'">Angola</xsl:when>
			<xsl:when test="$CountryType='AG'">Antigua ve Barbuda</xsl:when>
			<xsl:when test="$CountryType='AR'">Arjantin</xsl:when>
			<xsl:when test="$CountryType='AL'">Arnavutluk</xsl:when>
			<xsl:when test="$CountryType='AW'">Aruba</xsl:when>
			<xsl:when test="$CountryType='AU'">Avustralya</xsl:when>
			<xsl:when test="$CountryType='AT'">Avusturya</xsl:when>
			<xsl:when test="$CountryType='AZ'">Azerbaycan</xsl:when>
			<xsl:when test="$CountryType='BS'">Bahamalar</xsl:when>
			<xsl:when test="$CountryType='BH'">Bahreyn</xsl:when>
			<xsl:when test="$CountryType='BD'">Bangladeş</xsl:when>
			<xsl:when test="$CountryType='BB'">Barbados</xsl:when>
			<xsl:when test="$CountryType='EH'">Batı Sahra (MA)</xsl:when>
			<xsl:when test="$CountryType='BE'">Belçika</xsl:when>
			<xsl:when test="$CountryType='BZ'">Belize</xsl:when>
			<xsl:when test="$CountryType='BJ'">Benin</xsl:when>
			<xsl:when test="$CountryType='BM'">Bermuda</xsl:when>
			<xsl:when test="$CountryType='BY'">Beyaz Rusya</xsl:when>
			<xsl:when test="$CountryType='BT'">Bhutan</xsl:when>
			<xsl:when test="$CountryType='AE'">Birleşik Arap Emirlikleri</xsl:when>
			<xsl:when test="$CountryType='US'">Birleşik Devletler</xsl:when>
			<xsl:when test="$CountryType='GB'">Birleşik Krallık</xsl:when>
			<xsl:when test="$CountryType='BO'">Bolivya</xsl:when>
			<xsl:when test="$CountryType='BA'">Bosna-Hersek</xsl:when>
			<xsl:when test="$CountryType='BW'">Botsvana</xsl:when>
			<xsl:when test="$CountryType='BR'">Brezilya</xsl:when>
			<xsl:when test="$CountryType='BN'">Bruney</xsl:when>
			<xsl:when test="$CountryType='BG'">Bulgaristan</xsl:when>
			<xsl:when test="$CountryType='BF'">Burkina Faso</xsl:when>
			<xsl:when test="$CountryType='BI'">Burundi</xsl:when>
			<xsl:when test="$CountryType='TD'">Çad</xsl:when>
			<xsl:when test="$CountryType='KY'">Cayman Adaları</xsl:when>
			<xsl:when test="$CountryType='GI'">Cebelitarık (GB)</xsl:when>
			<xsl:when test="$CountryType='CZ'">Çek Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='DZ'">Cezayir</xsl:when>
			<xsl:when test="$CountryType='DJ'">Cibuti</xsl:when>
			<xsl:when test="$CountryType='CN'">Çin</xsl:when>
			<xsl:when test="$CountryType='DK'">Danimarka</xsl:when>
			<xsl:when test="$CountryType='CD'">Demokratik Kongo Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='TL'">Doğu Timor</xsl:when>
			<xsl:when test="$CountryType='DO'">Dominik Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='DM'">Dominika</xsl:when>
			<xsl:when test="$CountryType='EC'">Ekvador</xsl:when>
			<xsl:when test="$CountryType='GQ'">Ekvator Ginesi</xsl:when>
			<xsl:when test="$CountryType='SV'">El Salvador</xsl:when>
			<xsl:when test="$CountryType='ID'">Endonezya</xsl:when>
			<xsl:when test="$CountryType='ER'">Eritre</xsl:when>
			<xsl:when test="$CountryType='AM'">Ermenistan</xsl:when>
			<xsl:when test="$CountryType='MF'">Ermiş Martin (FR)</xsl:when>
			<xsl:when test="$CountryType='EE'">Estonya</xsl:when>
			<xsl:when test="$CountryType='ET'">Etiyopya</xsl:when>
			<xsl:when test="$CountryType='FK'">Falkland Adaları</xsl:when>
			<xsl:when test="$CountryType='FO'">Faroe Adaları (DK)</xsl:when>
			<xsl:when test="$CountryType='MA'">Fas</xsl:when>
			<xsl:when test="$CountryType='FJ'">Fiji</xsl:when>
			<xsl:when test="$CountryType='CI'">Fildişi Sahili</xsl:when>
			<xsl:when test="$CountryType='PH'">Filipinler</xsl:when>
			<xsl:when test="$CountryType='FI'">Finlandiya</xsl:when>
			<xsl:when test="$CountryType='FR'">Fransa</xsl:when>
			<xsl:when test="$CountryType='GF'">Fransız Guyanası (FR)</xsl:when>
			<xsl:when test="$CountryType='PF'">Fransız Polinezyası (FR)</xsl:when>
			<xsl:when test="$CountryType='GA'">Gabon</xsl:when>
			<xsl:when test="$CountryType='GM'">Gambiya</xsl:when>
			<xsl:when test="$CountryType='GH'">Gana</xsl:when>
			<xsl:when test="$CountryType='GN'">Gine</xsl:when>
			<xsl:when test="$CountryType='GW'">Gine Bissau</xsl:when>
			<xsl:when test="$CountryType='GD'">Grenada</xsl:when>
			<xsl:when test="$CountryType='GL'">Grönland (DK)</xsl:when>
			<xsl:when test="$CountryType='GP'">Guadeloupe (FR)</xsl:when>
			<xsl:when test="$CountryType='GT'">Guatemala</xsl:when>
			<xsl:when test="$CountryType='GG'">Guernsey (GB)</xsl:when>
			<xsl:when test="$CountryType='ZA'">Güney Afrika</xsl:when>
			<xsl:when test="$CountryType='KR'">Güney Kore</xsl:when>
			<xsl:when test="$CountryType='GE'">Gürcistan</xsl:when>
			<xsl:when test="$CountryType='GY'">Guyana</xsl:when>
			<xsl:when test="$CountryType='HT'">Haiti</xsl:when>
			<xsl:when test="$CountryType='IN'">Hindistan</xsl:when>
			<xsl:when test="$CountryType='HR'">Hırvatistan</xsl:when>
			<xsl:when test="$CountryType='NL'">Hollanda</xsl:when>
			<xsl:when test="$CountryType='HN'">Honduras</xsl:when>
			<xsl:when test="$CountryType='HK'">Hong Kong (CN)</xsl:when>
			<xsl:when test="$CountryType='VG'">İngiliz Virjin Adaları</xsl:when>
			<xsl:when test="$CountryType='IQ'">Irak</xsl:when>
			<xsl:when test="$CountryType='IR'">İran</xsl:when>
			<xsl:when test="$CountryType='IE'">İrlanda</xsl:when>
			<xsl:when test="$CountryType='ES'">İspanya</xsl:when>
			<xsl:when test="$CountryType='IL'">İsrail</xsl:when>
			<xsl:when test="$CountryType='SE'">İsveç</xsl:when>
			<xsl:when test="$CountryType='CH'">İsviçre</xsl:when>
			<xsl:when test="$CountryType='IT'">İtalya</xsl:when>
			<xsl:when test="$CountryType='IS'">İzlanda</xsl:when>
			<xsl:when test="$CountryType='JM'">Jamaika</xsl:when>
			<xsl:when test="$CountryType='JP'">Japonya</xsl:when>
			<xsl:when test="$CountryType='JE'">Jersey (GB)</xsl:when>
			<xsl:when test="$CountryType='KH'">Kamboçya</xsl:when>
			<xsl:when test="$CountryType='CM'">Kamerun</xsl:when>
			<xsl:when test="$CountryType='CA'">Kanada</xsl:when>
			<xsl:when test="$CountryType='ME'">Karadağ</xsl:when>
			<xsl:when test="$CountryType='QA'">Katar</xsl:when>
			<xsl:when test="$CountryType='KZ'">Kazakistan</xsl:when>
			<xsl:when test="$CountryType='KE'">Kenya</xsl:when>
			<xsl:when test="$CountryType='CY'">Kıbrıs</xsl:when>
			<xsl:when test="$CountryType='KG'">Kırgızistan</xsl:when>
			<xsl:when test="$CountryType='KI'">Kiribati</xsl:when>
			<xsl:when test="$CountryType='CO'">Kolombiya</xsl:when>
			<xsl:when test="$CountryType='KM'">Komorlar</xsl:when>
			<xsl:when test="$CountryType='CG'">Kongo Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='KV'">Kosova (RS)</xsl:when>
			<xsl:when test="$CountryType='CR'">Kosta Rika</xsl:when>
			<xsl:when test="$CountryType='CU'">Küba</xsl:when>
			<xsl:when test="$CountryType='KW'">Kuveyt</xsl:when>
			<xsl:when test="$CountryType='KP'">Kuzey Kore</xsl:when>
			<xsl:when test="$CountryType='LA'">Laos</xsl:when>
			<xsl:when test="$CountryType='LS'">Lesoto</xsl:when>
			<xsl:when test="$CountryType='LV'">Letonya</xsl:when>
			<xsl:when test="$CountryType='LR'">Liberya</xsl:when>
			<xsl:when test="$CountryType='LY'">Libya</xsl:when>
			<xsl:when test="$CountryType='LI'">Lihtenştayn</xsl:when>
			<xsl:when test="$CountryType='LT'">Litvanya</xsl:when>
			<xsl:when test="$CountryType='LB'">Lübnan</xsl:when>
			<xsl:when test="$CountryType='LU'">Lüksemburg</xsl:when>
			<xsl:when test="$CountryType='HU'">Macaristan</xsl:when>
			<xsl:when test="$CountryType='MG'">Madagaskar</xsl:when>
			<xsl:when test="$CountryType='MO'">Makao (CN)</xsl:when>
			<xsl:when test="$CountryType='MK'">Makedonya</xsl:when>
			<xsl:when test="$CountryType='MW'">Malavi</xsl:when>
			<xsl:when test="$CountryType='MV'">Maldivler</xsl:when>
			<xsl:when test="$CountryType='MY'">Malezya</xsl:when>
			<xsl:when test="$CountryType='ML'">Mali</xsl:when>
			<xsl:when test="$CountryType='MT'">Malta</xsl:when>
			<xsl:when test="$CountryType='IM'">Man Adası (GB)</xsl:when>
			<xsl:when test="$CountryType='MH'">Marshall Adaları</xsl:when>
			<xsl:when test="$CountryType='MQ'">Martinique (FR)</xsl:when>
			<xsl:when test="$CountryType='MU'">Mauritius</xsl:when>
			<xsl:when test="$CountryType='YT'">Mayotte (FR)</xsl:when>
			<xsl:when test="$CountryType='MX'">Meksika</xsl:when>
			<xsl:when test="$CountryType='FM'">Mikronezya</xsl:when>
			<xsl:when test="$CountryType='EG'">Mısır</xsl:when>
			<xsl:when test="$CountryType='MN'">Moğolistan</xsl:when>
			<xsl:when test="$CountryType='MD'">Moldova</xsl:when>
			<xsl:when test="$CountryType='MC'">Monako</xsl:when>
			<xsl:when test="$CountryType='MR'">Moritanya</xsl:when>
			<xsl:when test="$CountryType='MZ'">Mozambik</xsl:when>
			<xsl:when test="$CountryType='MM'">Myanmar</xsl:when>
			<xsl:when test="$CountryType='NA'">Namibya</xsl:when>
			<xsl:when test="$CountryType='NR'">Nauru</xsl:when>
			<xsl:when test="$CountryType='NP'">Nepal</xsl:when>
			<xsl:when test="$CountryType='NE'">Nijer</xsl:when>
			<xsl:when test="$CountryType='NG'">Nijerya</xsl:when>
			<xsl:when test="$CountryType='NI'">Nikaragua</xsl:when>
			<xsl:when test="$CountryType='NO'">Norveç</xsl:when>
			<xsl:when test="$CountryType='CF'">Orta Afrika Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='UZ'">Özbekistan</xsl:when>
			<xsl:when test="$CountryType='PK'">Pakistan</xsl:when>
			<xsl:when test="$CountryType='PW'">Palau</xsl:when>
			<xsl:when test="$CountryType='PA'">Panama</xsl:when>
			<xsl:when test="$CountryType='PG'">Papua Yeni Gine</xsl:when>
			<xsl:when test="$CountryType='PY'">Paraguay</xsl:when>
			<xsl:when test="$CountryType='PE'">Peru</xsl:when>
			<xsl:when test="$CountryType='PL'">Polonya</xsl:when>
			<xsl:when test="$CountryType='PT'">Portekiz</xsl:when>
			<xsl:when test="$CountryType='PR'">Porto Riko (US)</xsl:when>
			<xsl:when test="$CountryType='RE'">Réunion (FR)</xsl:when>
			<xsl:when test="$CountryType='RO'">Romanya</xsl:when>
			<xsl:when test="$CountryType='RW'">Ruanda</xsl:when>
			<xsl:when test="$CountryType='RU'">Rusya</xsl:when>
			<xsl:when test="$CountryType='BL'">Saint Barthélemy (FR)</xsl:when>
			<xsl:when test="$CountryType='KN'">Saint Kitts ve Nevis</xsl:when>
			<xsl:when test="$CountryType='LC'">Saint Lucia</xsl:when>
			<xsl:when test="$CountryType='PM'">Saint Pierre ve Miquelon (FR)</xsl:when>
			<xsl:when test="$CountryType='VC'">Saint Vincent ve Grenadinler</xsl:when>
			<xsl:when test="$CountryType='WS'">Samoa</xsl:when>
			<xsl:when test="$CountryType='SM'">San Marino</xsl:when>
			<xsl:when test="$CountryType='ST'">São Tomé ve Príncipe</xsl:when>
			<xsl:when test="$CountryType='SN'">Senegal</xsl:when>
			<xsl:when test="$CountryType='SC'">Seyşeller</xsl:when>
			<xsl:when test="$CountryType='SL'">Sierra Leone</xsl:when>
			<xsl:when test="$CountryType='CL'">Şili</xsl:when>
			<xsl:when test="$CountryType='SG'">Singapur</xsl:when>
			<xsl:when test="$CountryType='RS'">Sırbistan</xsl:when>
			<xsl:when test="$CountryType='SK'">Slovakya Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='SI'">Slovenya</xsl:when>
			<xsl:when test="$CountryType='SB'">Solomon Adaları</xsl:when>
			<xsl:when test="$CountryType='SO'">Somali</xsl:when>
			<xsl:when test="$CountryType='SS'">South Sudan</xsl:when>
			<xsl:when test="$CountryType='SJ'">Spitsbergen (NO)</xsl:when>
			<xsl:when test="$CountryType='LK'">Sri Lanka</xsl:when>
			<xsl:when test="$CountryType='SD'">Sudan</xsl:when>
			<xsl:when test="$CountryType='SR'">Surinam</xsl:when>
			<xsl:when test="$CountryType='SY'">Suriye</xsl:when>
			<xsl:when test="$CountryType='SA'">Suudi Arabistan</xsl:when>
			<xsl:when test="$CountryType='SZ'">Svaziland</xsl:when>
			<xsl:when test="$CountryType='TJ'">Tacikistan</xsl:when>
			<xsl:when test="$CountryType='TZ'">Tanzanya</xsl:when>
			<xsl:when test="$CountryType='TH'">Tayland</xsl:when>
			<xsl:when test="$CountryType='TW'">Tayvan</xsl:when>
			<xsl:when test="$CountryType='TG'">Togo</xsl:when>
			<xsl:when test="$CountryType='TO'">Tonga</xsl:when>
			<xsl:when test="$CountryType='TT'">Trinidad ve Tobago</xsl:when>
			<xsl:when test="$CountryType='TN'">Tunus</xsl:when>
			<xsl:when test="$CountryType='TR'">Türkiye</xsl:when>
			<xsl:when test="$CountryType='TM'">Türkmenistan</xsl:when>
			<xsl:when test="$CountryType='TC'">Turks ve Caicos</xsl:when>
			<xsl:when test="$CountryType='TV'">Tuvalu</xsl:when>
			<xsl:when test="$CountryType='UG'">Uganda</xsl:when>
			<xsl:when test="$CountryType='UA'">Ukrayna</xsl:when>
			<xsl:when test="$CountryType='OM'">Umman</xsl:when>
			<xsl:when test="$CountryType='JO'">Ürdün</xsl:when>
			<xsl:when test="$CountryType='UY'">Uruguay</xsl:when>
			<xsl:when test="$CountryType='VU'">Vanuatu</xsl:when>
			<xsl:when test="$CountryType='VA'">Vatikan</xsl:when>
			<xsl:when test="$CountryType='VE'">Venezuela</xsl:when>
			<xsl:when test="$CountryType='VN'">Vietnam</xsl:when>
			<xsl:when test="$CountryType='WF'">Wallis ve Futuna (FR)</xsl:when>
			<xsl:when test="$CountryType='YE'">Yemen</xsl:when>
			<xsl:when test="$CountryType='NC'">Yeni Kaledonya (FR)</xsl:when>
			<xsl:when test="$CountryType='NZ'">Yeni Zelanda</xsl:when>
			<xsl:when test="$CountryType='CV'">Yeşil Burun Adaları</xsl:when>
			<xsl:when test="$CountryType='GR'">Yunanistan</xsl:when>
			<xsl:when test="$CountryType='ZM'">Zambiya</xsl:when>
			<xsl:when test="$CountryType='ZW'">Zimbabve</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$CountryType"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name='Party_Other'>
		<xsl:param name="PartyType"/>
		<xsl:for-each select="cbc:WebsiteURI">
			<tr align="left">
				<td>
					<xsl:text>Web Sitesi: </xsl:text>
					<xsl:value-of select="."/>
				</td>
			</tr>
		</xsl:for-each>
		<xsl:for-each select="cac:Contact/cbc:ElectronicMail">
			<tr align="left">
				<td>
					<xsl:text>E-Posta: </xsl:text>
					<xsl:value-of select="."/>
				</td>
			</tr>
		</xsl:for-each>
		<xsl:for-each select="cac:Contact">
			<xsl:if test="cbc:Telephone or cbc:Telefax">
				<tr align="left">
					<td style="width:469px; " align="left">
						<xsl:for-each select="cbc:Telephone">
							<xsl:text>Tel: </xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
						<xsl:for-each select="cbc:Telefax">
							<xsl:text> Fax: </xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
						<xsl:text>&#160;</xsl:text>
					</td>
				</tr>
			</xsl:if>
		</xsl:for-each>
		<xsl:if test="$PartyType!='TAXFREE' and $PartyType!='EXPORT'">
			<xsl:for-each select="cac:PartyTaxScheme/cac:TaxScheme/cbc:Name">
				<tr align="left">
					<td>
						<xsl:text>Vergi Dairesi: </xsl:text>
						<xsl:apply-templates/>
					</td>
				</tr>
			</xsl:for-each>
			<xsl:for-each select="cac:PartyIdentification">
				<tr align="left">
					<td>
						<xsl:value-of select="cbc:ID/@schemeID"/>
						<xsl:text>: </xsl:text>
						<xsl:value-of select="cbc:ID"/>
					</td>
				</tr>
			</xsl:for-each>
		</xsl:if>
	</xsl:template>
	<xsl:template name="Curr_Type">
		<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>
		<xsl:if test="@currencyID">
			<xsl:text> </xsl:text>
			<xsl:choose>
				<xsl:when test="@currencyID = 'TRL' or @currencyID = 'TRY'">
					<xsl:text>TL</xsl:text>
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@currencyID"/>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:if>
	</xsl:template>
</xsl:stylesheet>