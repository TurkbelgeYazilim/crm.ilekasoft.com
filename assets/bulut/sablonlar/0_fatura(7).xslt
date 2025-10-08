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
				<title>E-Fatura</title>
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
										<xsl:text>E-Fatura</xsl:text>
									</span>
								</h1>
								<br/>
								<div class="imgBox" valign="middle">
									<img style="width:0px;"/>
								</div>
							</td>
							<td width="300" align="center" valign="middle">
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,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ABTyrxswpyIzhHyqLzzzzzzzzzzzzzzzXasLz+VnSv3xcHbwyXzxFqPPzzzzzzxzzzzzzzyzzzzzzzzzzzzzzzzzzzzzzzzxL83w83jKn3wNTzzGn3hhrjzzzzz7zTTzzzTjzrzzhfTzz1zzPzzDx3yFTzzzzzxDayJXzyuzrxV273y8p9ioDzzzziP7XbTyzEgBG6uOD2sZp/wj/Kh0rzzfzzzzzzx4tXzzzzzzzzzzzzwNQ9rzzzzyszPQG7z6nXdz2rwL4JSpfz78ST8DypfzzzzzzxdtuPzzzzzzzzzzzxP/AAc88888rLP/AFG0vvTym/KvgvgvKv8Az6ynhFTy5fzzzzzzzyJKXTzzzzzzzzzyJ78nzzzzzy8D7YLzt8F3iqir4L4Lyh3jpPQb9LbzzzzzzzzzwPkyHzzzzzzzzzw//jzzzzzzyxDL2Pzz0zJBfz/4/wC/Us28HbMK0dA48888888888SbXqt3ack8888+5B888888888888888888888888888888888888888888888888m3Wo+X9W+++++08888888888888888888888888888888888888888888888888z8FNdd8888888A8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888//2gAMAwEAAgADAAAAEPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPBi9CZmTzTTTTTQPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPMogRUHM0Pfffffft/PPPPPPPPPPPPPPPPPPPPPPPPNPPPPPPPPPPPPPPPPPPPPHNHNEoQo4k88888vYvPPPPPPOGYDWtPASH8iz3MPPiTvPPPPPPPPPPPPPPPPPPPNA/8/PPPPPPPPPC9vpPPPPPPKE3MdcfF6w/EyjJNPNtvPPPPPPPPPPPPPPPPPPMTFlfPPPPPPPPPPPM/SPPPPPPLBj5VBZV6sX4sMlnqBlPPPPPPPPPPPPPPPPPPPOOPRPPPPPPPPPPPPMv6tvPPPPKEDLFKo9K0jPICwPOPlPPPPPPPPPPPPPPPPPPLIgy/PPIPID6AdTPPPK86tPPPPLA8AVFiB7zoTZo71ZRkPPPPPPPPPPPPPPPPPPF2dnPPPEPAvPAQxPPPL8hEvPPPLPHoU/PKtP8A6cdz8rM7/wA8888888888888888be+U8888A8UMLBg28888sJVI888888888888888888888888888888888888888l9488888E8A88BD88888J8r4888GsTD555dApTwH4Tt7gs7888888888888888t++o88888G8AwgNC888888TOcj845cU2ogWMWskQymNMMlp+888888888888888/9y88888888888888888888BY0845WUIqDG8W8Q3A0D88Ql+888888888888888U8q1888GbA/wD5RfzFbUS/PL0rLPLKfjPAPPPHvGPaUrPOAu/vPPPPPPPPPPPPPPAHvU/PPO7rF7fP8rLOl4fOFKSPPPK7fPGvMeM/DCDwA1W7GMngPPPPPPPPPPPPPPPtudPJwfPFf/KruPI5vPMnohfPPPDPPPPDPDPLPPHHDDPPHPHPPPPPPPPPPPPPPLPfTPFYlZ1//P8AzzjEAsR7x/zzzzzLDDzzzTTAjLDDBjDDBMLxTjTTyrwpTzzzzzzn+ulvzzlbLyNAZoIZ80w73zzzzp0M0jTxGsA91dF52hPP82w4BTuv/wAHV8888888ljH8888888888888qV6m88888p07avCUB/xJ09AA8eW8fd8CW9YdX8DX8888888sHoy888888888888E9wc88888plyFsxpI35UOUAi++WUXV8W8XyZD87X888888882YT88888888888B9/G888888t6yOusjk9zKMAAC++WUTmEaaYh40+O+888888886Vr38888888888l9t8888888uPPlKcs3kjQtYUimumc8zxPrm7o05dc888888888/XJsKX16dMNNc/8e888888888888888c8M8888888888888sc88M80888888888AnY/Wq9L27zzz/18888888888888888888888888888888888888888888888888/zKyjjC+SyyiKN8888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888888//xAA0EQAB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"/><br/>
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