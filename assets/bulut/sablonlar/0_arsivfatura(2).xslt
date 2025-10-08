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
								<img style="width:91px;" align="middle" alt="Gib Logo" src="data:image/jpeg;base64,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"/>
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
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gIoSUNDX1BST0ZJTEUAAQEAAAIYAAAAAAQwAABtbnRyUkdCIFhZWiAAAAAAAAAAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAAHRyWFlaAAABZAAAABRnWFlaAAABeAAAABRiWFlaAAABjAAAABRyVFJDAAABoAAAAChnVFJDAAABoAAAAChiVFJDAAABoAAAACh3dHB0AAAByAAAABRjcHJ0AAAB3AAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAFgAAAAcAHMAUgBHAEIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAABvogAAOPUAAAOQWFlaIAAAAAAAAGKZAAC3hQAAGNpYWVogAAAAAAAAJKAAAA+EAAC2z3BhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABYWVogAAAAAAAA9tYAAQAAAADTLW1sdWMAAAAAAAAAAQAAAAxlblVTAAAAIAAAABwARwBvAG8AZwBsAGUAIABJAG4AYwAuACAAMgAwADEANv/bAEMAAwICAgICAwICAgMDAwMEBgQEBAQECAYGBQYJCAoKCQgJCQoMDwwKCw4LCQkNEQ0ODxAQERAKDBITEhATDxAQEP/bAEMBAwMDBAMECAQECBALCQsQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEP/AABEIAK0ArgMBIgACEQEDEQH/xAAeAAEAAgIDAQEBAAAAAAAAAAAABggFBwQJCgMBAv/EAEsQAAEDAwMCAwMGCwQGCwAAAAIBAwQABQYHERIIExQhMRUiQQkWUWF2tBcjMjM1Njc4QmJ1GCVDsyRSU3N0sjRjd3iBhoi1wsXG/8QAFAEBAAAAAAAAAAAAAAAAAAAAAP/EABQRAQAAAAAAAAAAAAAAAAAAAAD/2gAMAwEAAhEDEQA/AO1OlKUClKUClKUClKUClKUClKUClKUClKUClKUClKUClKUClKUClKUClK/h94I7Lj7m/FsVMtvoRN6D+6Vo3GesDTDKrXi12t9ryJtnLcMuecw0eisoTUCCTYvNuIjq7PKrqcRHkK8V3JPLf8/tg6Y+xPbvsrIux+Cz8LvDwrPP2Nx37X53bxP8m/D+eg3nStG5N1gaYYra8pu1wteROM4lhlszmYjMVpScgTicFlttFdTd5FaXkJcRTkOxL57cvMuq3TfBz1AC7W6/Ofg3LHhuyx4zRdz2y6LcXs7uJy4qaKfLjsm+3Kg3PStO3vqm04sF0yS0XCDfe9i+YWXCpZNxmyFydcxYKObf4xFVoUkjzJdiTiWwl5b/AM37qo06x66ZJaZ1uvpPYvmFlwqYrcZpROdcxjkw42quJu0KSR5quxJxLYS8tw3JStNl1UadDMOCtuvvMNSx0rVfDNbe11YR9HPzn/R+JInP8rf+DbzpZuqjTq+XSxWmJbr6L2QZveMCjK5GaQQuFtF8n3DVHF2ZJIxcCTcl5DuI+ewbkpWmsM6qtOc5kafxrRbr82WpErIYlpWRGaFGzszjjcpXtnF4oStErfHluipvxrh4n1f6X5hbcPutttuQtMZpid1zGD34rSK1Ct5Ni8DqC6uzqq4nFB5CvFdyTy3DeNKjunWc2fU7Acc1Hx5qU1a8otUW8QwlAIPAzIaFwEcEVJEJBJEVEJU332VfWpFQKUpQKUpQKUpQKUpQK4t0/Rkv/cOf8q1yq4t0/Rkv/cOf8q0HWfo3+pGiv/d2zP8Azo9F/Z1/6Hf/AIVIOnbAcxy7BdEJNgx6bJhuaEZRZ1mo0SRW5kmQwLDJvKnACPiSoiruqCS+iLW5rF0x2HF8NsMvW3PYFkgrodC0evMQH22U7hCniHWZTi8VL1AB7aqq+f8AKoV81eZdkYbrOww0bjrnTxhQAACpERK9IRERE9VVa3VnXTlqXqjkHUHardAYtUXNy07KzXK4moR5CWxxt+ZtwQj3AQ4p7uymqJv6qm78XZttufbl6RaQvvTBtUOyrkN+ArUDsOIKoyyRutlMcQeREOzHbJSVUNN96knzByfIPfz7UCfIaL1ttgQ7RE+rdwDKWSp6L+PEC+LaelBrO+aUaIWLM8xlZ1fpF/ueYZVac1DH4YPOzI0q3sMtxjCPE5PuNiUcXFIk4brsXu77xbHT6SOqxqfK0o1IhR8gvGVWXMb1DalqNxcn2s2lbF2G+vIB4MC0Stigrx5Iqruq2ax3FcaxGCttxawW+0xSNXDahxwZEzX1MuKJyJfiS7qvxWvMFfJUmFllxmQ5DrD7NwecadaNRMCRxVQhVPNFRfilB3qZP026kWS6wJ1ujRb0zceo+JqS94J3YoNnOELBk6jnHcwcHzEOfukhf63HWOCwpkDO9MGZ0R6O4XUfnjqA62oEoHHuBCSIvwUVRUX4oqLVEtE/lOOrDRrw8B/NRzays7D7PygSlkg/QMlCR9F28kRTIU8vdX0q9mlHys3S7qxMsga5YQ/hV+tEnxVvny4yXSDEkqBNq6y+2HeZJRMxVe0iIJqimqb0HF6dP0r0n/1nVv71LqOaG/qRoH/2EZz/AJ0erW6b6KaNX+XpbnehmosC5Y1pzKyWVFahSwuLcs70jhPAT4nu2oOuqSIqEu3uqiL51pfHdAdTNJbTpdYcjsvim8L0fzSx3a42/k9DalumybII4oovviJKPIUVeKptum1BZfo+/dR0d+w1k+5NVt6tQ9H37qOjv2Gsn3JqtvUClKUClKUClKUClKUCvwhEhUSFFRU2VFTyVK/aUGpshlZpkDcNzRXJ8dlYdBE4c2Nj70cLk280XFWo7zgvRNkROKtEDRCqfnR9KYjP0fx29suXW1S8eyt//Rgk5f3CuDxF/gMz5BuA+n/Vx3jFN/JEroPyrVXUrSTqDz3ItMs5vWM3FMounJ62zDZ7qJLd91wRXi4P8pIqfVVtNG/lj9S7TEHGeobALRn1neDsyZsRsIc0wXyJXGtljveX8KC1vv5rQdytKqFod1QdJ2svh4uh2tErT6+PbIGM3BwIral8GQgyecZU381SGQkvn7yVYT2/qfjfu5JiETJIo+s/HHEZf+lSOFJP3RRP9nIeNV9A+FBOa8tOTfrHdf8Ajn/8wq9OWOai4ZlUw7XaL22lzaDuO2uY05EntB/rHFfEHhH6CUERfgq15p42E5lqBntwxzBcUu+Q3V+c/wBuFa4Tkp4k7i+fBtFXb6/SgidKvdor8j91H6hdi5amT7Tpza3NiIJZJOuKivxSOyXBPL4G6BJ9FXH0o6BOifRuekRMaums2YwT4PMPgNwaYfT1B1kOEKNv6oks/h5EtB1V9OGA9U2TZU3c+mSzZsl1aNGzuVhcdistfyvSdxaAV+hwkRa7remg+rjT3EiuvWhqfp57OaaEWjRtG57Rr5CMiUJNRd/qFs1Jf4962tbLHqPPgMWq3hZdObEwCNsQrUw3Mng36igkQJEjEnooI1IH12OszYtMcPsVyC/LAdul7bRUG7XZ85swN/ykbddVVZBfVW2uAfQKUGcsF1s9+sduvmPSmZNquMVqXBfY/NusOAhtmP8AKokip9S1z6g2hP7ENPPspafubVTmgUpSgUpSgUpSgUpSgUpSg8xmt37aM++1F1+9uVCqmut37aM++1F1+9uVCqBVhdDuvfqi0B8PCxHUiVc7JH2RLJft58JAT0AENe4yP1NGFV6pQdvOmHyuPT/qxDiYz1O6WewHxMSG4sx/atuB3/bIHHxEck+HAXFT15JVxtLRsVvxCBE6Z9JLPY8VuEdqVEvU1pIEWYyYIoSQYBFlSiVFQt30ZU0Xl3F33rzgV6XOmL92vSb7DWH7gzQZH8GDt+/Gak5ZcMlQvMrc3/oFqT6R8K0XJ4F+ISXH0+japjbLXbbLAYtVnt0aBCigjbEaMyLTTQp6CICiIKfUiVyqUClKUEG0J/Yhp59lLT9zaqc1BtCf2IaefZS0/c2qnNApSlApSlApSlApSlApSo9qLKkwdPsnnQpDkeRHs011l1olE2zFg1EhVPNFRURUVKDoX6tOjTqS0v1DzDNsi0uuknGrlep9yYvFrFJ0UWHXzMSdJrkrHkSb91A86rBXfrjOvOoGG20vFSWr/bbPbbu8Ue4Gay5BR38iNlFlqpEmzdmYaUjBxVQyJdyTzjmpmivRF1FPus6racQsMyc7MV7mX22GkAWQR8mHDKYAi08QmPrIb8xIVRPJUEOi2ldj+sHyM+eQofzm6dtSrVmlqkNJJiwbmYRJTjRJuHakCqx390VFQlVoVRfKqLaoaJ6t6LXX2Lqrp5fMZkkSi2s+IQMv7eqtOpu26n1gRJQQmvS50xfu16TfYaw/cGa80delzpi/dr0m+w1h+4M0GzKVg8mzjEsORhMkv0WG9K3SLFUlOTKJPUWGA3ceL+UBJfqrA/OzP8l9zDcHW1xD/JuuTEsdFFfQ24Te757fEHljL9dBOqh9z1VxKHPfslnelZHeI5q27bbGwsx1lz4A+Y/ioyr8FfNtPrrV98zHTJ563N5tqTcNQ3bwk9WINnJAsm8RonJDZhGLtmCcUHtynX15LsnoW0LvWvuXhh3ZwqxWXDbdHsd5EYUJpHzjPsR8gRo2XOLbYiJ2Vs+PZXfuqm+w+8FitKLHc8Y0tw7G73G8PcbTj9ugy2eYn23mowAY8hVRXYhVN0VUX4LUqqE6MyJknTq3FPuEuc83InMeIlvk88Yty3gDmZKpEqCIpuq7+VTagUpSgUpSgUpSgUpSgVGdT/2aZb/Qp/3c6k1YXNrVLvuGX+x28RWVcbXKiMIRcRVxxohHdfgm6p50FIrj+gL7/Sb/AP8A7ison63f+V//ALupC7ovqhMt0q2Finh5dzsl6IWHblD5svPfOTtMGguruZ+2IioQcm04u8jHinLmvaQ6mRbv7ak4mTTHzTQNjuEMS8Z7S8R4Lze27vb/AIt+1v5dygg+MXi/Y9aLbPxi/TbPOm4/YIjkqKoqfDt4e2PuuCTZKITJSDyFUTvueXvLvsSd1EE9j+WQtWcFtOXY7bIFnechNw21ckNvwGpElXW3zVl1UInCEURtNkQf5qwrejOp8G2QbemKo/KgWOzELLVyhoUl5r5t91hrk8nvh7FlqpFxbXdviZcl48fMNCNVlsGeQ2cXB0p9ts0OAftGIAS3AtzcZ7gpujxRtwV5dzhuibhz9KCC6sfJ0dEWtN0vEfT+8ydMsmgTvZ7yQkNuC5LI3gEQiykQHRUo74okYwFVZNN9xJKsBZLe7pFpfjOD6o60tQoOKWm24+cLFYTgSX+1EUUV91O7JRCbjOu8mRjqAgaqSiKlUNzfR7UG837IFiYs3LCdeFOEnj4m8hl0cgVJIiTqKgNrdovLkiHuDqiJcUUvpmeieo0m95Zc4GIB2Z94Iwf8bEbSS083fw8Sqk4ioDaXaIJIezmzbnATQR5Bmg1dsGJ3hLbphp7Etsl3OY+KXa53ZO/KuDQy/DvPK6LiuulyFxAN5xVREQiH+GoZacxy/M8mx6RleSzrmsbJWZMYDUGm2VOTipIKA0ICqAk6WAqSESC8aKSqqquVc0pz876VzGxsLFLVNbujntOJstuW4OSfFfnfyeBonD87y/w9vOuTiWiuqNsvNmkzsSNppm/Cr5+NikjMdlzHj8QqI4qqBpZ5SCgorm5NcgFCJRDVWI/oHTn+j3X/ANlYr7zv1Omf0zIf8rOKmWH6JampAwS2vY6y09bYF2i3FPacQ/BktvbjNEfB0lIXHAXjwQlRFTmgeaJ8ntJtQnrCllfsUaLPl2q9ocd67wUOO+8GSCzHcQXl/GGt5ibKHIE2c5EPFOQWW0V/Z3D/AOOuX35+pzUR0otF2seB2+BfLecCaTsqS7FcMDNnvSXXRAlbIgUkE0ReJEm++yr61LqBSlKBSlKBSlKBSlKBWPyC/WrFrDcsnv0wIlstEN6fNkH+Syw0Cm4a/Ugiq/8AhWQqB68Ynj+caM5ni2VtTXrPNs0nxrMOWsZ55oAUybR1EVRQuPFfJfJVTZd6Dp96ZdRdeNRurXL+srD+nW86qOtS5oR4rN0GE3a3JIK2wHdMDQu3E5NICJ6EiqqeW/O6vddNW+szXfBOnLPdNnNK/m/PVbvbXbuk9Y6PNA89OfMWwFEZhibiJsqoKuefvbJdnQTJMZ6Y9MnsJ010zhxLbGjXi9XDu3h156VcWfbAiXcJr8ggsHFfJFFHQ2ReCqUF/BDo+7qtnGfXDTR2fkuf4hc3LpKk5LJIGpFwllCkNsCjaK00rZkgkiqQgqgibedBo/5PaPYNeetjL+oi+zIlsx3BoqM45DmyhBY7bjZQ7cwiGvmjUNpxFVPQxBfVazPyqeqjeuOuOnnS5heTRVtduMLje5jLyORmJMjy7j3FVTaNFE3iX4C8X0VL9J/k9ek/UfJbfaJmD5Hb41wx5u7g41lDjrgPeEtclxtUVlEUNrsAiW+/4klVPeRBkeC9IvSRieteSaGYtpNmj+STRl2OXc3764ngbA9a2HJNybLiggLpzPAImxKa95EVBRxECoHSpkerGQdTty6kdJ+nS+am2rDwW1Wa2BchijaYvhliQGyeIDQyaht8OKD67F5eW8pumtup3yknVHYun3VnJ39LsNKdIa+bcFVcIZEYDM2nTJBR2UvbMBNwUAF/Jb3VUO/+gy6PdLyTdD9K8CuMWCeqDWISZcq4996TMkWJu5eMNVHfiLaAwjabfk8t/NUqDXnpN0muvXOmTN6Wy7ffVlM5x7bg5obO/bMd5PgPCqPvSh4GHf3LkR7bLtQUV6jMPs2UdW9m6cOmzSF/JsS0lJuM7jlue4ndn2jB26PPvkhKjpqgxjdNF27IIibII1OOs7r46k84vcXp7yjDHtBIU1Y7WQis4pcx2M+qe+b4A3tHRstyBtNy2ISJUVQq4+hGBaA6A62X674Dgt9cyfLNQpOnM+73O8rKNC9kre3ZAoopsBkIgQ7qSqIly8uK8/rQ6Z9Eda9UsBnaiYbLnXGXHW3PT4d2OE4MP2jCjAHEQJHFF259xN9tkE0/iRRCu+v8rSD5L7QodM9C5Iz9Y9QoCtScod4rOYgquzkpNt+wCkiiw2K7ckU1UybVSptm/SPfcI6TIHUrnuQlEynJr9EcgWORIFJJWd9t9fGuCX4wnHXRbIdvJG9yXdS9268PQPQLN8lwDUfO9Mrpf7hNgm4+Fyy6TJaRi225l2Gyok0iOCoIAOIWyLsS7LyVK+2q+g+iGsmRXDV7UzT263C+XG33KVO7OWSAabdht3lGGY4drYGOFiUdvUe+O2/BeQXN6L9RHtVelbTLNZcs5UuTj8eHMfM1I3ZUXeM8ZKvqSuMmq/WtbprVHS1g2I6b6HY9h2E2AbNbLcUxrwqS3JP45JTqPOdxz3i5uIRefohIieSJW16BSlKBSlKBSlKBSlKBWIy+zv5FiV7x+K6229c7dJhtm5vxEnGiBFXbz2RV89qy9KCrh9NGpsm1yIT83GGnJ9ouzDyhPkGLMqQt/wC0AqsdObf99t8nFQSTsFsBck25X9nXUz2r7V8RjHL5teB7ftCRt472h4nhy8P+Z4+73duW/wDh1ZmlBpDRrRXMdPcptl0vkuzOwrfjTdr5RJDpunKWFZ47nuE0KI2K2kiEuSkSPJuI8V3xlg0I1MxfqcyjXm15ZAet+XXBi33O0yZLxCViZtkcI6tpwVGpLM5uUSCnuG1LcUiQtkSwVKCvV40L1JueusfIm3cRYwZvNI+euSWifC7nMZsi2zwhtdvtGCrxc76uoSCnDguyFWw109vC9QA6reKh+ykw5ce7PMvEeIWaj/Lbjx4cU235b7/DbzrYVKCvT2hepMnXiFkhu4ixgsDNHM9B+OT4XZ+adjK1+FcZ7faUUU1d7/d5KgiHbTblU61P05yPMcyw6/WV62hEsru09JT7gOI37RtsxCaEWyQy/u5Q4koJ+NQuS8dl2XSgqtjnS/qZbbfhsKfcMYRbHDuUSeTM2Qf52CEZkmt44891b5GhcOKLsnPbz+n9mTU2RYRtUmdjDTsi13dmQQTpBi1JkjfhZAN46c2/77bUjXio9gtgLkipaWlBF9NMdu2K4XBst9WJ49tyS/ISI6TrIk8+47xAyACJE7m26iO+2+yVKKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoFKUoP//Z"/><br/>
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