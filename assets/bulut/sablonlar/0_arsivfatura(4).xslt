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
									<img style="width:140px;height:110px;" align="middle" alt="Imza Logo" src="data:image/jpeg;base64,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AxAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//EADoQAAICAgEDAgYABgICAgEDBQECAAMEERIQITETIBQiMDJBUSMzQFJhcUJQYHAkU3JDYoE0Y5GgsP/aAAgBAQABPwD/AP2VLbBUnMiHMqlGSLiw/wDeWX3oM9MKNmYAG3P/AJAbVEGb55JK8tHgvU/gwZFe4HVvBHsNtY8uJ69P94nrV/3CJk0s/EGbH7/9CsgZSDGx62lNC0AgH/x57QgjW28vxPXAPePYqnt+ZyCiNafAnDke4hbh4BmM7t1YVrY83W34EJUQoo0wn68z4i0eEi5Q0NxLFf35VmuwMHI+bGnAk9rGlBcXkFvdYxRCwE+LsPiC+9v+YlV9otUOd79t93oqG4wZsqyzY+gnUkKNmPmIvgbnxif2NK8lLPCmBw31iwHkwZNHj1BPXo/+xYHQjYYTY+ibqlbizgQW1nw4M5qPzBYhH3CetV45rOaa3yEFlYA+cd+pIEF9JOuYjXVp5aI6Mu1PtsyKqjpjPWq4luYisGGwQR09er8vHzKFnx9MGbTPiqZ69WyC4BguTetz1a/3C6KNswE8+17Ur8mHMpWJajqCvvZ1QbY6EFiHw0DDxv6htQE7YQ31KAS0F9ZG99oLa28MIGT+4fQuvSrzBfVxDExb6nOlcH2kgRsupW1PiKv3EuSwEiAg+D9AkAEz4yifFUf3T4uj++LbU/hxOS/se0kCCys7AcT1K/7xBbUfFizmn9wnJf2PpM4UbJgy6tT4+qDLpI++B0YbDD3cl/Ynq1/3CfE0+Oc9RP7hDk0/3iDKqMF9X5cT16f7xPiKf7xEuqfsrg9OQ7z1FnNZ6qfuCxD4ac1nqJ+WAhYDqXUT1UgsQ+DLMpKzBlg60IcpBPjU/sM+PT9GUZQtJHD6lj8RC7g/uBh5IhAYz0V14goJeGlx3Czme/NCphAP/KUKOrj5n3+5wUbMCFgzcTCflVuBguBi21jyZYC53KWZW0Yjb9pjmyx2IWATlqU79YPAdj23dqLDOKmsdzB8oBi2cLAfMptFi+zN1wWLWpBmF565TcKpvTAFdSsWDl+QYgcgoCfM/lMFSG0gEAkmJbk+NxMtw3BxEsR+wP0swuLAA0BZz83GOiDfEE7jd+KdxDpW+XsYllw8doLrgjFtSnJSzz592SAtzTg3kCKpJ+flxjKUIUE6M9MjR0YQXacAGAMXfEb6Zu/SmkV00CYV5Wabcx9raV9t6E2u0Xj6bAzETjSI45KRLaOHiICDy4z5uXPUaxrARxAmmQqZYFt9VxC2zyiv2P7jmwgcjMf+RX/r25aMzkz01Pfc5ui8ZS/OpG92b/KEUuqkeJg+X+pf3sOj2hPNQpGiIlQbyZVWee9+DHPqWEiPzTiRYZXk2o3zwX1EgB/bmd3rgCsFKbBmIurz1JAG5ZkWF3CmEOfLmKmtjzCBrX+YST2L7ECWJ86d5SSa1LefefBm+G+PaaDb7aMA0dGWDR2IocgasiG2kdmlWad8bB1vANZhqnpgLFHIa/IhC/oiIm9+REe5dMCSIcxpRcly+17FTyZfZ6jATaoOxJMCH02dljV/qKg8t4jprxKb7K2+YkiJYtg2p62jaGWaDoJw4WbHiEEsSR2mtHxuLSpU9+8UcRo6MNZinjsAbJhQqp3MTj6qdMqxl7LEdgG3FawHzLObEfoTky9lMNw1+S04MSTqV3kcEIgjnS7ljty7N2hd3GgJzsAGgJskbbU0D3E8wbH57R22w+WYej9NjoSywMdQ2bOuMBYeZTRYe5laFR83sepH8rERUGlHW0btI3OPaY40k0Iaa28rHxa/KiMw5ah5K2/IMo17XbiJZvf3mK6r93eMysp0sqcJKnDr29t+vQsldg0qFY9hCkcROWhvWpi2fOV9mQAUnI1/kkTEKcj1yhuqEd41hXQA7ynFt8sY+JePB3Frv/Nc5cW041D97EKSZSDz561KchLO30csEWVvLK1FvnQMHql+CLDiXE8y4hxrEBdwDAtwXmfE4E183J1+BFIsQqexExr2DhHgIPsuYG50igqDEx3sG+ep8I+xu2fDT4UCHGqPkdcntUZX/CAcqSZajOwdfMR3r5nwTMewvQpPsutK38JZWQSw/MxA6U6bocUl9myfDpPhP/3y2p6X5ag4sdAxATyRT3MGKmocKqHBTxzMrQVoFHssfgjNPmABJ++cRv5W7wAEOGOiJiOnHivuyn41TjyI22lmFoPb9S2qWAKB30ZVj8lBM+GUDSsRLMLsOMfG7rD47KCRDX5LDjKMkhdP7Mr+dTPyzJ+5hk+s/XIdQjLuAADz3i996Ukyqi1+5+WfA/uyHDgpsruQ8foHwYSCWGvE2Qg7alam5/HaXU2b7Vdp3TX3LD3XYhrJ5GYlr90Y9LhtDFXawkDzMapyd8I+MSO09K5fNYMB79tjRluvHCIxRwynURwyK3W2wVoTCXu2SYUFUJV/CmJVfb2JIWDF7dzGxGA7GMWBA1CXVT8oIlbuFJrlVgsQEdD4M9JzadqZ6L7/ADqejZrSpDW6AcxqNtSGhFT8dNFVn38hAgoAgpt0S6mYlTo/MjplDTsYFIPdp4eKr2g6llJ7SqvQIjI7DtsSjGcOGbow2pEOO4s7A6nouPAiUWlvmjUFo2Oxj45WckG973C2wZg/TvfiDEJYbMFY4klu8or5nl9KztkSxx6cxW2nsvAF8GgCTKODEEe3IbWhDtt6mLULBuX0AfnUCEDsBMbsPbawSpmMOn+YRGsRuUe5IbCCDx1FbkOuUH0NNLQOAHmYY/ikjrkNwqYy0bUFTsiUcjapIHsZFYEERrLMc8G8RmUJ8uxuA60V8iIwdQQfoZZA1sTgbl9QsO0xNfMR7LMZvNdk9J6ieUQMjd12DMUum1b2XDd9kLOh1x8xPtHvyQWqIgssfsz8RHt464DlLhY4TtMYWVWFD7MgI9zgy3tUJRy9JOXtyDpY7L5WY5VbEBHcj6GVtzXV+Gj6dwv6iYg8mWr/ABnWYlqVEq82D3HtzBuuElNdtf4mApHP6jEc22p7S/fYynfpJ/r2GhOfMeY1m+Q8nZECMUUAyh+VY65nmub4VkATDI9VuuWh9VmibKEzAHzsfqHxCoDkx2I3MTvQOt1Plk7GKd1NtgCDFARw7EiA7EuOq3MUFUJcajIeXH8TG7U19b6RwLgTls9wYdfivYmKf4XW9/V2oMRSrjfjjC9WjolifAlNK1r7GQMCCIKzzIYmLyqMqsaq7sYDv25ZACia0NnzPtBbtuA7APtyhsxU4/mU6NoQiAADsPqX3aPATzvcWkWOQJWgrUD6eRrvF0oAEcN2IPY9jKV4p9LJqY2Qct8T4lBUg69lo5XbgPkSlfmHsMZ3ttaHko7zFrCJMpUKcmHiGw6GxqIfStB3AdgH2WoHqYE6igBfu3G/Ff8AcY+NVw7JD9hH5mLZsdbvAEVQOWzMVUBJXregesiNYB21K7A1ydgPawDAgwlhYysB2lmkO+EwX8r9DKErYq+h4MwSN2D230i0RmKbBSNaWBB8RDtVPW3S32Q2b0fKgxDtVPvyHCJszhtZXWLEKAaMel6ynzFtyjkLihPsyVLXEiM+u3DlKSTWpI0fbkAECLQxAMo214DjuPeToS+wvcpUeImmyRrplV8CbBOVYqII+aYh3Qvtzt6SWEldTCII+pY3HZlj89albckQ/se3IT0X5iL+yJQ/C8r+G65XldLuLyLnmdEfiUIi7I65RAt4xbFrPjzML77PqHxGPcyz7ZijVK9bmC1kmfIFAbuIjeEcBh+DF+0S0gVtFubWuBML6buNr+RKwFrUDq5ARifGjFTX52DO4Te5Q3OpT0v36NkUAgbMcNWg77mFV5s92TUCkNhAZdbEKkgzDfdXtzB3SdvBjqpCrv8AMXwPbbzLmcwQdypSbFK/UssCCOwJ3Gf5JjU8QGPn6mROXcAypQ56s3ET4v8ASwZX7SDLdrAFEfMCsRwi5IYb4GA76W79TZMPGY7oOU9WsLvkI2RUPzHy9+ILeXcxOTEhQT/kyqviPZYdI0q35/JMcFipPgSvsiiOOSkSx+DhWl3Er2mM3KkeyxR6TgypE77G4ULumj+el6qhiMa3i91HTK71Qg8OOzMMgEoetn2P/oxQ6AvpT2/ERw7psAaPuzFKuHEW3XJWGxKGKOpGgCfoZRY2hINISGmEFCN7sgk3usPEH5hMVwa+x65I4XcoiVufOomuI9+WnOqVLZyIHmYve2yMoZY7M7qr9isxXYhttvrYdXvNhTyPgCVMGQEe3McKggscqCvmVPu8Er3K++1gEO4jeqQo8THTeS7dLk51sJbXszDcrYa/bl/ap5TmB3mF3sc/Uu0bLCW8N2ErK8X/AA8r3wTf6HtvrFiQaHyiGt+YceR1ySo0SIwNqhh90xezsC+z1y+1yGOeImPca+5SAg/Tb7TFatzsA7juGbwZh9qR1zftrH7eOFA0R2ht+X5VIiDSqJlHVDxS6sAfEZmr38gIle/TTY/E2N66ZL6paBWZV4mWBVr0WmLXwpHS/vUwiIyj5ppZhdqPcw2CI1fAHRJnIzA/5+3M+ftH7CcD8rjzF8D2HxCeTusVFA4ykFX+mzBRsmWvuOqqQ25XjByDANfTPiXvoiOo2CZUnzoQ3WwfLAPP+DGU6lPgwKNkyp1ZmEXx0t7lpVUzgncelt/cZ6KgGIFSLdX4sSVpXZ3QRK1X25jfJqDtKeVjgdcxNusTgapiG32WDkjCL2TRPeFyjJAdgGZFPq8TLx33MR91qp6ZW/SljgHvMPrf/JslXygcx2iGsXBVG1PuuUMk2PUP6HmWouuaGISUUkaOvffXYb+xgAf7tTDJFxHuyQy3F5uuw+Jh6R3HW5grd5dR2DJP4icRU89fLld17gqJXkuNq5mLezuQ565VprSVtYBsAlmmMCL+mTSwc2CN/Desh/MB2o6XuPWIlin0jKgBWoH667EOVSCQTMpkcVkNPVr/ABMarVvMHY9+Vt2WoRlbHAlSBF7Dra/GzjqC3VwfXiK21B9l4Vk4mMhrOgwImPrk31Hcc2/Zcy1K9c1H+xK9cE144j2t4MusKaCjuYbXXWh3iNyRT0yd/JAQngTGQi5265C7qeNp9agY8GAHYjUAYEaJBgybqTp5TfVYOx+jYBwaUua2OtSwctfsmUcK0CzYMa6tN7MstN9nKHv907MwSDwJeN0sIFdhtjELEKIM1f7GnxFYJs4942Y34EWz1W+bzFrYeJVjAHm3XL2K4XtKA+n2lgQhQd9zEUIoA8D33+SAQDECqO/czDcetYPbleQYrO2gVhZq7F9xqdrW00AtW3iT4hdk7xr3DjiCRBlncGYW2BBdc43z1KWJTud+0nQlthe788Yz6HYSnH5nbiKoUaH1DLqx6gMIBB3KiQ6jqfEOLdzYgiehbw1zENNtSzcV6kHLUQ7UHpZ/P1uGrX/NpWbWYjWxLabCnYQVlQNiW6lNvDsIpBG/beObHvOyju0x00N6621q6943Y8RAeLjvqIdqOreDPTfkxJGjHDjyARFGlA6XIyP3+yVuQ4cA8RFOwDMv+UB+2EZlL6dZihQx0euQN0PKwxXfIygAZABPut7o0T598lhrZbQADBvQ378mwpYgWGrTTEUevZ7r1JuQwKobkBMYD1XPXKTnBayqFMr58GslKXH5zOBAPER6Qbql1EwylobrkqpqbcHq8EeszDP8Zul5AqYmepQBvy0xbzZsHpbxsuYaiEONBjE1wEfJrQ6jXZIJE5EjfJtzQHmAKfJhX8jxKLDU8OVwfTr2gII2PYSACTLf4l20eWO9tyj2WoOaPO5dlB1syjYrUE+zN/lRqbFHzgzERxyL/UvTVs18pJPbUr+xf9e0x09XejPGO2/ui/aOmQnMQjSzEYN7MmprQvCBLK9Ey8LsuIH2AHUQhVbttTMfIbnwsb6Da4tubrc60f8AYjBl/wArH5DiS3ymc/xz3BWh3PSZUHEbMZyXAVNmU45D836XHSGWK51xgFg0wOjKrHBI0satuO9A6noctuRxEoKeoS0VFA7ezKlV/b02PadrLQPwIPHvIFrE67q0152Jifefbk732ETlX87SvdlvP3W12FiVfUA0POzGJbYI7RSCNR6xy5RE8mcHGuB0JT2X25FwQTkhOxEGz4laBR9bJ2hB1EZfyOzRCF7P+GlbBl7e23skNhA3xBldnLWwIvgdL1JfQig8V5SgnvvowBGpamiVmivceZTcpIHstcIhM5HwywjRMS9QoBhzK0gzqocurUHJyp4x059j2MxS/EhursFRm/QgLHRffDlHsTt8sHgdLwprbkJyLAoviY1hZSp8rM7+UIrBk7rMX7z1v7UvLA5RTX3BlaIXBYaIPuvZlXtFLntYRqcbWPyOPoZApLAN5lyWMOXITAYl3916F7jp9SgEG1DMD/n1uG7H+6OER6991MqRUXSj35ClqmAhtC0BF8zE4bHRgpGiAZfVX50JTYKrv8GeZkkch+Gjc1Xj2m7bgqxMYKPG2l9pr4+JZYpJ4eJS2/FAYy88NfwtbieYFcmKSUIs7rKLfSJrc+y9kFZDHzP4QHybExbBW5DwOv7mx0yCxACRxybQHf8AcovBIRvZmgelL3JdEBmIXPMlvqXk+r28Ax+LLvlK/wCWn+h7bGCoxlBBB3LnRB4BiEMiN+x0zCeVaibHZT2JmJ8ltg9rKGBBnwtcdkXanYMV1YFdbEdF4mYuTz+RvfZv02Ildi+NeZxA/wD5gfiSj9wIldXnluMtp7qsx6bQxLRaEVy/W7XA7g5FV1G7MFfyYmJXLcXkuleWV2VoFMqca46mNcyWcD7M06rlSchrQgHpuYhBUH33uQx4+TE59g8xBq9/bksy2JqNaLG040k1XWPu7EwDQA9tvNrCC3aJxbyTEBd+CHxExyCdtPQ/Zhxv02ocUEd7GgGhr2O3ER7Tz1x3GbY2qzHQ+W+vmc9QaGu3iOVczGfj29t32GBeaiJUFifaOjd3M4tyYmVNdz63p9rQ6Agda3X87MUgjrknkQk8CPZVYAsKAkAxqxAqNXviIqIRsCAuplhcmUcl6sPlMBPpBD+IFsYA9oPA6MAwIMKCq7gYjCu/e9AiZhBRIU9QAVuJSxFwUDrevOoia4gfNOJs+UjR3EHFQNk+3IYu6gHsILPuEx6nawOD9DN1zrip8u0CTBBNthPtJ1ORL2N/mCzgN7mIB6fLrexrt89jGySdL4Er+xffadaihXB5IOXKVcBkEL1uTnWwjIdAa8RMwrXqWO9ndjFDWECY6itDBddf2rHGV4X5tiU1INBRAqr4UCZnY1GVqC+yNjUSn+MfyhlmOAjBZxNlZ/azDuDp1ydPfUkv/m6I0IzjxrYioG0Nw1sg36jS02+p9xAaD7e5JiKeYX8DvLjWgBUfNFYMoI/I63fbOLPaRMZCicfqM5F1gKkhjDUefaL9o9ua3dBAAngRarLmHM/LAAAAOmZrnVDUGGw5aYq8Xf3kAjRllS0uAp+6aYuO4AiIiWA+9x8hmuXdRGBWvmZiVg1lz5JmgPA91+uB3FI+UfjU4cWPI8likFQR0yEJr3Ow+fY1LhUQDokyhg1Y65I5VGIurACY9bMd85Tr0191zcKnMKc1B/MO+IJmGPvb25Xa5JtTpf3EQepw8qPc3e19eRAN/jUoBFp+gTobhuNg7iaBiVepYeJ7RRofXdVZTuWitY34I8blZG/MSwaG/ZaCUIiDh2JM1thsyvXHpa1ovM5amKWYset2jWYLbSun1HU7Gpjnt0J0CY7h22I7NzCmYlW2ZjLKizKRDjswILRKOC63BUP0JbT2JELHuAJSWXezK/tHRvtMrrPJ9D8x+Sle3bcXwOtqgjevEZq7GEID8B/kdpdSOQCrqYvyXMNdcluNLS6v7O5EV/46j222BQY55KCsBUoW/XkTFpA+f6GYnMpE5JvYOxMP8nj7cp+ThOUTgA6k+JXX6pQAgxVCgADrd90f7wOOzuINKPfedVwueB0PmmFw79bbkqG2llpdjNypfLFCVnqsv2gcZRTWo3AoUaA9l7AACVeorsQCBMffxL9LqStx4+DKS9bEiKwZQw8HpzZzY8FjN2I2TDiOwBHaDCceHj4jt29WPiO2h6sGLenh1nC5dlwIWvXZHiUtteuR2rMrbQ3MQkqSfqNaVvYNCNXVkweB7GIAJlgexh4I3O/IJr8SgWh2DdctOZqEQPS3jaTGJOS30MpVZqxy0ZdyRgFMfkwo355e+zYrcjzqKH3y8Qjakljx86mJ/IX35ABrlliqPEuACI0TXBdeNddKjtWwgA8zG+S5l62LzRlmvmI19sJI7zDs5BwfdluTaEgOrBoy1mZdamKFFII9uYd2pFKKYBx4lR7mUCxmj6fwSJidrXB+hfb+BEAUTtY3ARECKAB/QMoYER8URzxBHAwgKd61AxKyuy0eZ6lo8EQ5Fke64rqB9txM1s+e8r7L0uPEzz+JQ3pWsOpGxMhWXxFIaUs4sA/HS1uCSsAa0O0uIJU677lS6X3MpFtu5UpEpf8AHS1S1bgHR1ENnpcuUWwuZWSUG/YaxVa8L/P2B2DLL3cfkTFLmwHfW1Q6GI9tigyshcn5psfubUeWllyIuzPifV7J2hFi2t83Yw9oKvWK6T/ZgAAAH0L7hWwBnrl27qJj/b46b1PWrPhwZ8RZY/5AEL17LdyWlfp61xJJlFCp39l+zf8A6WKVaxGWKQRNj9zkv7EW1H3ozko/PW4DgdjtE4gt32DMb0t7QdL8sJ2SMzOeTHcA5EBVJjVBATKWscEB56Bs/Ooi8VA9uYDwWJ8SDr8TE73t0vRiA6eVg7OSexb8TBfs6TKcpVKOfzdpiLyv9zLtSJZbwDgTGYgL1yOPEEiFl18iamJYoGmebE3Nj9zkB+Z599g3dYm4KFPey2V8QigNsATcNtY384luUq9l7tNWXDkzzjxA0ROD29l2Ii8VA65u/kAlpK64tMUMTsnq9iIRyOtwEHwepYCXE3WedARKj3YtKi1l6j8Kfe/2mFd6JgddOpmH3oX33ryrMZl4eNgSy3mncSg7or65gK3cpSdbBMJ4MLIpDKCPB65KcSYumG4lno2bEV1b2W3pWpj82QOe5IiceXzyok5CrAAB7csE2aWaA0r62ZUdOB7rSSSN67weO0xe15/yvvufiJ87uYx4iY9PAcj5P9GyBo9LHzGDKNCIewgVFJPI943bxA+iI9g5EhYnNn5alJOj0ybOLCM9p8CUoXbbezKB0GE3X9wi2EupAiN8svsUdoVOjowIWdIg0o92QpDqQNgxuwIJlLhW8wEEbEbwZTWQTsT09WbifaPZmFk4ESu0HY4wg+kVPkyoVoynfW8E1OBK0trI79peGZx3gLAcdAxKVb8zjxI78v8AcdlD8oxZWBY+YtdzkceQEReKgfRzKyxRhFqH5DBhOTJsqT/kQZDNDzcnbNERlYa7iHeiREFH7PKUVcF7+3KP8eVkLW5UfMDNX2ptI4C/k8583HjKAUuQR6tWoGPYnrkECozuu1MwuEyMkk8UM0BKMY3DZOhErWsaUTJR+U0aCGI2ZdcCRwMpYvUjH23oHTRgydBtr2BmH3tdutzobtSg8ckTLdWZK4WXuq2KJiU+mpJ993IXN+pysAC8iJW3JAemWNVzgXrDAxlUKBr5p/H4BC+hDy0EQtylpL2duxEbk3zHcwf5R9xlp4udanBuW9whh/z1KyeX3sYauVml3CyISDF3yLdwDKqm59lPExVCj2Z/msw18qywMwk0vXMOyiTgBv5yIHtRezwXXEQgltlm3HRy00eKqrd5j0GvZPk+9vtb/U+bg3LsTAqhQWBlYAQa9+UGNfYw126/BEFYP3zHAFKa65abq3+VguTwR/poVBB13BExf5Wur1h0IMNXpiMqhwQYB3FoOjFynDcTPWvD/jUvd7NASujs/eV7VQJo2/IJXWtagD3W7W9+8LrsStQGGz7TMg6aIQRvc/iK/JDDflGHIvnxF0OTYomNY9t3npdslhuLsDvNz4l60gvsdZ69q9mEGQfwG3Gtv/Lz1LB5JmNx7sPz9dqAYMVxYY1DT4a+CjIGuwi49m/m1EoRettAsInoRKeBJ37HQONGLhhI2KSJTXcnZzLMVjYXBi41/wDfK6bVO3I9lnPgeHmDehvo68lInwdn/MiPhnj8kpQ11hT0NGSCTsQYl6HcUaA9hAIInwhR9rLKbCDoRMO5XUnrajMnyNoyyi8kFWhovL/aIlF4PhI+M7ePli4Fh8tPgE/LmVY1df08mkvxKxRlHalIaMj+yJjsF4wYj+psmJjOjN37RcGv8wV1p2RQPddi+q4M+CdDtSIlFo3uyHDP4eLhv5Z4MTxyePjF3UmzrdSlqaMTHWobsMtsDuSg0OlVXb1beyylw6AhdDpbXzRlnoDjxM+DXcUcVA9rKWETE7tyMrpWvrkgC+VHd9f+42IXt5Fo2ACezRVCKFHvsq5iPihiIicOw8dMjH9Xj3nwniJjacsY1NxY/bKqrlLclWWYwsWVYxrB5NEUIND3tjO1z8vEsps9IKghxrCBzhxSrgrPRtAPHyYcMt5MWpQAIBr25SO9elEGLdod5i0vXzL9b6XduSS2m5AD5iMvHjZyB/EC8QzdyZy5KWKkCV41tolOMlX0Ldip9edQeoFJYNCXVh2lP2D35y7piWFgDo9paXKElQAZUeVSH/HUgEEGOgpJDDf6gGtFG7/kTFyDUSLPZZWHXRjY3Edprv3E5ox2dw3eBqcOOjzlxArUDvuLVexX5SBKqEqBC++8/wAeEp3IEU6tQ+0y1hzKmE+mO0DOQmh5mm2Z4Mcb1FrUVzD73OemT+xLH+UaMX5VHIziDB4jWVzs2mWBGJljEbWYndB/5I7og7mX3m4wkeF3Fq4adx/oQ1B+BcTx9fKQc1eUd70/6/JKiltzDqIBYzX1OK73ofQIBnFf0I9SPrY8e0qp8iBEHhROCEaKj3MgYQ4qGDC793j4nN9l4lCIAPo24odwdwUVgRcaoEHj7nxQx3ygxxx0YKEWHHQ/kiDEphoqJ8TgutaldCVkkdCinyIcOiDHqH4nprPTWfD1f2z0EgrUT0Kj3KxEVBpR/wCR2WLWpJltxtbZg89huY2Nr53nEb3/AEObvazE73r/ANffjXPZCuRUfBAleVeG79xFYMNj/wBVu6oNs0uvN/4nk6AmNQK1B/P9HmPtyswhu3/sLSAjbmuHf/ExQRSP/VV1oqQmMxs27HZgVmOlEooFaf5/pMs/xjMH73/67Ld0VSsTKuHmJZtvnYkGLUbiAniKAoAH/qm25ahsy617W2RFDN2USqkog/uiJw/JJ+kTqB0J0GBP0cl+VpmCnl/+r8T4uj++AgjY6cV/QgRF8KB9E21IdM4BgIPg/wDd8lE5r+/6LY/7VbFZmUeV/rbXFaEy13dh6kAZjxXvKKBSv7b6mTU1telmJQ9bkuPoXvwqYzRO5ijVC/8AV2cuDcfOoiM4YaG9ykMKkDfUy6v4jvuYXer/ALt+zS1yzhRB4H18nZUgGcD3HKD1VHZpU3KtT7rMkh+CT4qxfKSu/n7LchKYc2oT4yseQRFvqbw85qfB9zWIvlhPVWCxCPMBB9hdB5aHIpXy8FiEbDAwEHwffv6vBefPXf8ArHdUG2Muua1yfxPPYb3KaPSs2P6bOfSBYAx7D8xRxUD9D/rAiDwo+q9VTnZQGJWlY0o0P+7sRy3YT0buYIg+vkEACAgkice0x/5Ke3JfjXOCqe0sFvkeJRyGtmA7HW8KdbgHfvqP2jHQ2o7wM+oMi0Dl5WVWK68h0ZgoJPiPeH+wwlNkbO5wJOuTQdh2cxbXUiI2x1uT+ITvzOI5BeRhrVeyyt/S2yxcuV3JaOx9h7Ca9axiWlqmogoxlT803rXXKtKBQG1Bc5UNynqW2E/OQIXt3x9Qz5gF/jMDBZdrfqGY+QXfh0syLCnIHUw3d6yWb2X3Xqx4iYjud8m6cr+bqbPExrnZyj+18m359PMViaAWPsyb7EOliZVnP25LOAAnmLkZD+OMGb+HEtve6EzEo4Dkfccm0Xff2BgOwD7L8p6n0olb80DEa6XFxWSnmV5QYhSCG6WvwRmgzTrukGcIc15bk2V6lOS9tmpmnd0rfgY+S+0hze49t+U6WcQIl958pMS17A/Po54Vu/6EGa/9kOa48pFyNrufHj+yVuLEDSyzhqfGEPxKx8t0fRSNeFIB8mJcbA2vxDm7T9NMa82+el+TZW/ESmz1EDe2zL4vPibiSQvywZkTN/vEqvS3pY/ACNnHwogyR22sbLqWJaln2nrkOyVlhBmjXzCVuLEDex24IzfoQ5nbYWfGwZgPgRs1B+DBmgj7Z8av5SAz4yvkQQZXfXYdD2W2ipCxhzKIMqkz4moRHR/tYH6FjitdwZ1Y8rKb0uBI9gyaSdBocqneuUGbRPjKP74Mqj+6LkVN+YtiP9rAxmCjZnxdUOVWIcmkeWi30sPvgO/qMyoCWMTMoMfMpWV5CWDobEHloMuufE16hy6gJ8d//aMGekGRXFZWGwY16qYcsbEB2N/XuXcFaqzbIlbI2outD23qbGhLKdExrQgGxPu8dpR1ydfmL8p89omMG82GDGrA0JcDWRPn32aY++mUXc8BAFRJTQXPIwUoI+MvcicLN6CblLOpMB2NxyQO03yJJnholdLntYVeWUPUvIkNBRzGwSIOx4f58iDwOtxAraKOKgbj8kYNsmYlhdG6uiONMNz4JQ+w8bF0pIgFRO9yoer48CPiAjQMoxmpcnlD4lyKngHUwyPRHss57YqnKYnLnaW6ZSHmhEx+2T7LDpDCvdAfy0AAGh463nhS5HnU+fiSxJjdgNCU2B6lb2ZpIAmPH4Gw8fEMrrbYYSh+Zftoe66itG5nwZVwCAIdj2ZXHkDKCCgPTKs4ASgE3jZ8Do6CxSpiY/EAFtifCsLeQI1GwgY1SpoOeUxiqG0wbYkk/sxKlGOWgrFnhoaTXp/IlLB6wR1MLu9+9fbLcgBNAfMZgjSN0cBkZT+REPBge5ESk31baPieOBnwnycZWvBAsdOepZiO772BLEvUAsQwEFGzzfvErv5MPAMGIsooNJfoQBlEuJjPzFn65+2zi1h/cWqy3f4hxXAGiCY2K5ExsY09MongAIte2G/Mem5tBR2l6NWUJE/TqSJQ783Rm30cAqQYVR7CJWAEUD2WDaMAN9oMe86BSGhUGykaqvysdW5ADuTDTbw8RabC42hgGgBLgBYf7piqQvXIvFIj2s40wilNEBdymn5dlJk9wPlMxE/ifQzRuoTuBsruYH8nqfEs4GzSCBFE9DYhqB2BHAQL4MUAp47GYSS0fKZxALLvYiKrKARvU9FRswoG+0aIleS9fn7YlqWeD9J3CLLL+XIGcEbxF4EhD+IaSO9Z1MU2aPIzJUGGhYK0XyO8C7tAhO2IgX5jvREsrAUnUxNelMgBjCNsAo7xBpQPr3cvUB32AjAE8osXwPba6rNixwQIaAU3Ps/O5TegJ63howJI7CVfb46XhWXRmgvYSgRuwh5sTGrJIUeWlacFA65VKsvKDwNGY9vLamWAkdo6Dlvcb5RuY6V6DADpk6Dg78iVqATF8DrlcjaoV4lHN9lty2sLMUgWOo9pnpHcxUKId9T4lzDTfqYPsAIvt7nUxfNg6XKrId/iV3EWox9mWQKogaywJ+B7Mo7UV/l5WOZdR+JYoUkEEGYJ+9fZlBiU7bEdtEoPE7Sigv3I7RxYlgHJRKbtniBy/Z9z2PzuDLtQJhivgSnsygRbMYoKuIcHpk2BSolPfKX3X3VWy9RWmgADELBgR5jgCjRH4lBJcJoQJYLbP7dTE+xh+eXW1gqGVuzEADcv7ODxmHw03Ho/2mUFjxAHgweB7j4MQsosA2JisXoUn2XNu3gPJExq/TUj2k8BY5/LHUw2LU+3NB4IRKK39ZCehAMy6goGvBMUk5A0el+/SbRiMdaf/wDzEACLr3gPtz47nUxQ45cx7HDPzP5DTHO16MQoJMtte07HgGcGcoOGwfMStEGlHUIi+FH0MxUNWzDxaokTD/kD2HFoJ3wgxKPPCZWkaqAGxn4kbIlWLWidxswVVjwkCqvgTL7VQfYSJiJyrJaeimocUpycHc3z2GXU7VupWUWh039HKbtFA7Dt/mJSGURMVASZZQT9jalVXpiX0vZoBtRMbj5aW0/LubBAYCIpLgbi41az0k8ERUVBpRqX92i2lWGwAIjBlBH17104fc5KzRDtoPA9ljBUJm9kQBNjUI+TU4EM0qqp8nrleBE4kqxia4wnXmX2nwg3FVyTyPmUjSTJfjXK+YACyjntuXsKhgQYRxtZIh4WIZ+IUXmTAgbYaUoEQAdMkF7UIjE1shi+B1KuXaw6ImICK9mZIBrlL8LAYp5AEew+DLEJBIMo7VJ7L0oRZhfyfYzojWFz5mJr5+/R15I6/tYiaVw3kGUuHrU9bq+NxYNMMkhyfZln+KupjpxTf5aZSIU20xXCWezKtNZXTw/cdSio2uJ4mZ3umEhBPuvyEQleMx+IpXS69mWuxKa0QbVddMwd6jKdLk+2+5agZRSG1sTJfnc0xBu9JkAmptTF/ny5OaTHu0+j1yXINaD8zFDq1gIly+lZ6n4Mq46JXpceNLmUkrWG/AMU7APuPgz4hVZgVmGCKfZlgF+SnuJiktWCfbePkYTC/ke3OBK1yldWDXgDrlvqrxKjwCnpk9qWlnzKgUSoca0Hvv8AyAZjrxT2Ny268u+5iIU5dMs6rgU8RYBoShCqDf1M/tTO4rKTGINK+7MVzZFHZGQxfA65J1VKyCzDUpUKmh1ya9ryEXZ3yExXFdxT6Nx5MRN6I+U7lf2L7rD8hgA5GVDT9TLGHqATIr0qtKft+vkHREKcj27GUqwbv7cgckKzjKK1B6XFVcD9xC223EO16ZI3qPx0diIz8flaepZo7O5WmQ8rq4+el7LsCbTWjMPh8/En23rztnFSyf4g7CWOoY7IEfiOJJ7ediHNnxFjiNuxDomVUbVC/V2CKSYeYRu3ymUrwqUSxOdbLLEUDxv8EzGINIAPsPgzZYFRbMf+UnstQuxmHv0fYVqZ35/cDKVXlyHW6t1fdaefMxH0719CQBswhm9Riw8ylFrrAHVmCqSfAg47YgnvF+0CMNqRELoz9u4lTixA3R3WtdmWubHLTzoRLqEQaYR8lAm1mOjvyZpVUKlIHusKHIKlIXCDudRslFXcN40pAJBhzKhF4EOUsJLSjfpAEdMriSgMqA+IXl7CeIJMufnaTKT6VHNpvvuYSdi8yiRSZip84J6XEix1P90Vgygjpm93SVAhF35mZ3SYT7QjpcP4Fn+jMcgUJHyDV29PtBms50tU+LTS9j7D4j0GwEnW5UQUGvZd2vPeYX2Ee2ynbOS8xv4deo+VWgnxqflGiOrqGHTJTmaxKlKWIo8Tkv7j2qg2TLbXcp/k+JTUwJ2vbpcoatgZWwGkcd18GIQVBHv0TZaG/MxefDv7Cx5uSQZiPz59MksbuMqsYOlbL9XLAKCMWJI4GYf8n3ZrEWrPkVeR8xfA65BArnqDZ0pGhKe69SO0JYWnYij+Oh+i/wDPM7H8DY8GVsCgmwfbb9sZuHeNaVevqfBluuezGZnBA32lG/ST69rFnZSvic35ytibF37bX+cDc5rvUp0QSOmSumDwNy0dSs67dMhtFRHXlKqF8iPSfxK3sTYcERMnZisGEyF7blXpNZp5W1fcKR7bNG06MC78weIdWWOCPDQoCeMeka8Tmta68mY1iIvEg+zKNnYJFQvYh/HW35LSOPYyhqQ+kPssBFT8fPGBQK/I7zHAFSgewt5YHYmET6Psup1cZijiWHW/YXkD4lPbIB/DdM3vRCquawo0Yo0AP11yGRavm/MpUtYn5QHrkIBZ28vMEnboYSFBJMvuNr9Kq6xX3Hz7l9aKofhHuQlOFcouWwe+zdl/ZfsltRvAhxT6PAGCrLCqAEhxbS4Z+MHpIzHR2JQSU5H89MrwplJL3Afo+y6wOxq1K8Ulx+pmuOHGADYiIEUKJeCayIjP8Sq9MoHwB90p7VKP10vYvaFHTKtVfkK7JEwgAh6WcfSbl4IgFlSAj/8AkR7bLDwiYtySrEtSzZ9h8Qh1B9MmYu/S23kn2WjhkFmEp0V2PbdeQxESxjWoRNkw41jEEgR8a1xKEdKwG6XtwNcdygJlJRmLkGIUINZmKqlAfyOtp0hjhWQuNyj+TX/r3k7Z9/gzC3p/Ymub7H5MxtabpcB6jGVqTen6C/VywTVAWWtxML+R7slx65WWn5RE+1f9dcv+RAGaz5ZV49j2q1xH4jlOSBfIYfRvrDL4iqdkbnAoTwcyi96XiuGA9ln2wOw7hCYlTPaHcdW8GWDuZSQVf5tSsaXW/r3qRcG/BnIbIlVXz8t+xuwjoDbyJhNa92MW8hdJK7bOLcnha1u57xXC+RKn2emT2ZGh5Me2tSsaUDpevKphEHYDzqUjTy9OVfmEK2jxExrageAHsPYTtzdlH5lTOXClOhQ+tYQfJlaP66npkoF1ZHs38wlZ2inrfZyuABldnEx8lUhyAFBhb1e8YrXrS/NuKdgHq/dTPRrAA2CZibAf9ewDdf52Jid6R7LHcX2aP5mKX336kAggxw506jw2hB3AmSHITj/dBURejezNfvWILvTZdQ5dfPiATPWSWWIbZjOOTzLu5ngOldRrTm8x+T28mE0DPQrDFgJR2yLvflv39NfJmMX4acdx7L+C2MZh/wAjpmtpVEoCi0cT1us4ITCpd0dfI8wdgJYTa7vKKzbZ0yyRTKbH51jpmKeAIlGUeYQy2wV1lpjAm/kR+OliE31tMYWhrOfS6v1KWWV3kKOY7RQOI7e4+DLCEVhuYx3SnsvctdwmN2TXtAD2u58bMpZGT5PHtzeyI0Km907dvJi1Io0FllCaJVBuUmxLQvV/tM1Y4cDxuUjVSD3jXK4E/kzDJNXU+JciIwIPeYXdG6P2taVb+J+rkNwTcCcqzxO5jpwqA92ZwW6ADmC3iL9o65Q3VFc74qkxnDp7GO8h+0WtTYr/AErKA52Doxq2HkQqoYu/gS68OAKwZjXGwd+tv2znwbQgDNajg9W+0yxSznRmvTYEiVkFFP17zOSue48SoryA37LDpTLVLnzAvLtrcSgqfEux3eLSyqAI6MpJiOWHGKewmT+IdnWm1KPsHRvEcEWEKPMp3vuIy8lIjKEr4k9xMYqAPZk8+A4QDj2lKE3B/wADozkX2xHsFi6PnpahdCAYo8oZiswYIel/amz/AFBWQh/cqS23uBqCixvvWfDFmEeu2rbEfJLPt2JjsGrX2GzkPALTEYmr2ZfNDtRMKwfZ7GcE2vx77mIeWz7L0KcireZjMfQBMsYuSHOu/aY2+HnfsyHR3b88IFdlBWvlPhXJDA8TFofhwcAw0WUkPwBjsznn4ijZAmLQCeTTJ4mvu2pQjIdFtwjYIgUBeMNTlrADMawOnue308p2lVqWjan2ZTqXIImGSaOmawCgSigAo3R3VBtjoS50t8PKKGDc2fcyX1WQD3MQMEcfuYacaulqhkIMSjTAkb0ehGxqXlGYAAgy+7aV1zFGqh0y+W1KmYfLgxPRthGI/Ai1XlEPlYPA9zHSky0ljy/ExRqhPY/a+9pTxKhh+fbWAHWs/sypVRdL7chSVmMdv1cOLiQRKbEsTY6W/Y0pOxYu9EmVjSKPey8C/Ig95RrXb2WVD5j5JmKnBOmSwTiTARyrfl+fq3/bPVVUZZifyR7svQ+aEq7LB2A65J1UTLNamJWUBPVjxUmKvHnvyTKf5w+pfSfIgH4HaU2MHEB6W/bG4l+J7GY4Ibud9W8GdvVJJ0JYVYGUNyqX695HPUKk77Qr8wIMXIv8cYL247ZYMgt4SWnazxuY6jW/ZkKIBKSSNTJnfyIlugI14UeI9rtLSAUIMpFhYEnplVtyBEKb8HRi3WVa5kMIliEbBll6ViM9lrbJIEWVAgdHek2t2jjsOIO5UXNa8x36X1BLtwswr5gkESly1SN+SJln5AINkoiGAaGupAIIMsU0uUHcGYrEWFerAMCDF4AkaMxC3DRX2ZI2E/3Gb0rwVWI6uN9Mh+FTQDSeR2mJVwTl7MwlHWYy8XILdjHXm/EHusxaTXX363s4r+QSqng69/I7wDQ11dgqlj+I7F25ERFZmAXzANATOmMzNrfW9Dz89nmF4dfd8j32B1ErRUGgAPZlI+y0wP5HTNX7DNo9iFW6ZjfJwmLUxblr5YJkvzuMBawqgiqFUAdMr+Q0xdo37RuqVkWsjDY3sNMrs/kGUDVKdMwr4mJsVdCAQQYLHQFQSNGVPzRT0DKTrY9hAIgqc8lHhTKe1SD/AB7CEN1pMoyKiJsQkDrd/MJCNuUnlWp6bHXMsK8VmMoB89XSsMW13MoHpctny3S77DLezAiJvgu/OvcfEVS/M/5mHoVey1g/IAnzMHw/S6sWIROPMFW7ETFvPdHPu2P2Pdmb4LA1YWYy8aV92VaqniRLEU18lEr3wTfnXXL/AJRlHdO8oAFY65VoLogjciy6P5lFBFpf6jaCncDrz7gic92ooXrb9sABbkRoysatXq2tHcNYBcfiP9mhK2JQGEgTkP3Ng/UvROW5yb5gDFXjHOu5M5EgdiZSSuzHs3rRh250fBmKCoI9mQgauFbR9sqZhrfmZg3wWKupaHOgJ/FUAeYzBfMRfVfRQ6irodGTkphx7KzFIPZ10Y3BDrZ0Z6Va/wCZoymn8nqSBbbv8tDYUeI3NFb9jplg6BAnKx1FcpPyCZNiMeBlJBtRQfbmDujzm4cFV8Sp+ab1rofBiu7pMNi1fsZFZSDHxuJJPfvOZ4OOJB8aiO5XibGEOwobnzG4qNa+l+0xRxAHsyK1ekxhsDbrMUcr/ZmWaQJMZeerD5HszLeTcId6lB9J+ZgOwJlBinYTG5iwAIR1v5cNqNmC+4d/Tg8e1qmsyLBEGkUezMDzBGqB0yE5VMJjfza+PS/ilqud+I1tqWEqCu4t98Y7cvrUpS3vYgmLc/M1v0tH8NhMXaX6PXKcr+DMcCy6AaAHTLTTrZMW31FPVCq2uWnpne624ynKXw7R3UXc6yO0qcWIG6nwYlyVbWY786gfYzatb5CZxBJ2eMqvJASWF7EZV8iYRbuOll4BYgiYtjdxGutUnYhsdLD38zC2OfTIQOo2sw177J65P2AnwDLrlYKEMRgyzI/lNPmsI0PtiElF37yrPbZWO3fcwe3q9T4mqgWOz57ykaHW9AFLzgXb5YmTdWAvDlDmJDmpMa83b7TJANDwKwq5hpgn5H9uTriuzOC+e258S1QA4doc39JBlyrK9Szj1yWXnxiuoYKdcSIBpQOuT9kQt2H/ABlFgpQqZ8XWY+S77CpEQeeGjAA9npf43FUKAB0yXb8NqL6pBYPKd+km/bZe9bRMqpobEC8uUsv/AFOattWmNTuzn+B1u+2b2QdQ1M7oQereDG+5tiCgOfulaLWgVZlg8gRObD8zE8H6lmM73858MeR7wYwCz0BPRWeksFAHgQ4o5ctxUCj2EbnAQVpvepbjpd5JiY1ST01H4hrUz01/XuatG8iHEqnorBUo9horYklZ8LT11uPi0v5ERFQaWFEPkT0KVIIT2uiONMAYMSj+wRUVBpR1+FoA+yIiINKPcaq+/wAsOPUwi0VL4WAAeB7fM+Go/wDqWKir4UD2NXW+uSgzQHgdci/0RGJLEn8zGoNjcm8QAD+jAAGh10B+OpAPkTMdXcalYNjqhgAAAH0AiKSQoHsVET7VAHUqp/E0P1AiA7CiHHpJ3wHtNFLeUEAA7D2FVPkQ00nygMWtEGlUCcR+poDocenv8kVVVeIHaFFPkQ01n8SulKt8ehGwRKKPR336sAwII7T4Sj8JFRUGlEdA6lTEpRE4j6Bxvnd+fmU0ilSB7GxmOzyAlNZrTiT1PcEGHGr8qOJi0XKWJMFNkOPaT+hMXHNJaX1m2orEwjqYtBpB9uZW71DiJVTaOxBgpcggifDXxMRgNNKqBW2+uTVY9naeg5cLowDQA63+AsNENZ14mtH5QRONisGCHRiVFlPOLWqeOuTSz2w1WghOErGkUexiApMNhbbce00hPYxCAmozd/IlKmxj27StAigdb/sgAH3GVoTcDy6t9hljaB7RbfnXa66ZHDvzaMg18sxd8f8As++/+jYhQSZfd6r7lSerYFiqEUKP6q+wVVkmDZ20xaTzFn/jhAmpqaH6+qUQ/wDES3GqKziOSqD5i4dUStEGlHsZQ09JItFatyA6+RPSWegm99Hqrf7lnoJFQL4/8WzLv+AhMxaQib/J/q85/CQKSOIPcnxKaxVWF/8ALbxeSBXG51gPwAaJmW8wGH/kruqKSYSSST5MxaRY5Jnj+qdgilj4Ed+bs8xKyz8//JuS+Nj3kgAmHKpmRbU3g7lNauw+hsD8/wBL6ib1ucxAQf8AwbLt5txHhYO5AlNQqTX9Xm2+KxOIOgvcyhDXWq/+S5IcV/I0+QHfM7lbs1ak+5lDKQYcOoz4FP7zKaEqHvduKmM9hcjcxC4LAn+ivu9JIch37k6gsGidz1lHhomSsWwGHxLbGQd3MF7uQNmGy7fywlgpL2ExrCANs0q327w+IMhySBObPvbtK2NKnj3nrZP7ES+4+QIPA9tlwQwWkkyx7NaV5TlOvZ4liP0yrXq4lYLbrCD6movgfSPiNkZKdjKMk707QEEdG3o6nxVpG0WVlygLjR+uSACTBmhrFStfY7rWCTBnr+Uj5ekB4SjJW6ZNvp19MOnk/PrZYK0LHwIjh0DaIhOoc+seFnx6/msyq+u0dj7iQASfAnxdHW24VcZzXet/QJABMq4Ozl/JmImyXI/omsVPJgII6B1Pg+7109UV9GYKpY+AJXclo7fRNihuJMW1GOgepdQdEz1E356q6t4P1BbWW48xuetX/eIHRhsMDAQfB/6hgGBBgwxAAAB/QMOSkT4UjZmNR6X9FlvvgonpMSAYuLyHeDFqEsT0iw/EDW6HACISawW867y/iaUOu7SupuMFLw4Zby8dF5CsyvW4/iKy+AdmHEsP/OJjuPubcNBMSoj22NxWH5n4DyZXQiLqehV/YI+Px7pK1XkHBld3I6MzNaSVIeYg8fTtrJf8cdQ43EnvFtepl/IPWh1e1u313LBSUXZlguelvwSPEo7W1DWvZeguyePOV011gAAQorDuAZk0KAHQcYWLeWJldZtcIIiBFCjre9gNaJ/z6XXP6/CU4taQojDRUGPSUPOmI/IfjY8+2xeaOv7Exx6gKHuBB46ZVqFxXqV0hTy/P0Mq/juvXkRVYtoSoaQf0WZW3IPKTupDGGwRMeq5Lfa4JVgPJExKNuXb8RGLbJUiEAjRlAKZLIPt+jloQ4dYHIsQlNd/PQnQJMduWyfJmInz9aw4yXVfAP1MlWFh0dAyjG5CfAP/AHw4d8pvap/Ts/6e+6+qyfG/tZS7uvIy9yiEjzBmXDyJ8bd5CS22yx0PifFWBB27xcuzmAU6X3NV+NiDNgzPnAKdCdDcOYPwhnxySt+aBpbZ6Y3Bkg/iJeHfQlrOg2o3Pi+3ifHftYMwT4gsDxErytnTCA/TtorsldBVtsd9CdCXfMSVMoUjyZ6bsrAv2iYj8gXeAa6O4RSZWSfmY+TKxLPtMr4JYABBGtRSATBr3XuA4DSs1rZ1PiV1Wcm2vbcStV8CZA2FgYL3PiLbWQNOIHUnzNgQEH8/QtrNl5UvHxfDVnTRjxZ+QAMouFqdKhxyn/oDC/8A8mv2GgesLQeuZZxXh0w6dLzPVmCqWPgCUE3Wm7oUUuG13HsqD0WDn4Y+2w8a3P6ExaN8LOl+R6XYT4Y3fP4+g7BFLHwI9pe0uYquCH/zLrG5dmMxbX9ZQWP9DapYESkaqQe9yy8eK7795VXZXbb44nrQScv6Nh3lceUdrKm+cStw6AiXcPTbn4hrQVc1JaUWLzHVHIy3+pmhnuAAmHr0+uTUPW/2JhsxRgf+myk5aiOeREXuomUdJK8Qt3sMFFYHiGivXiZPJbpUlhtXpb9hjkc5sDR34MU7UGXDaeYiaHFoFCleTA94OwGpYAUIMcECYaaXlLBsEy4EPuUY4t7mHDSHGuQfI8Hqc+58Su1+Q39QkCJlo/4l15PaWsFA7SkO1oIB1qDsPZkMznQ8RR8ygRRoRvEQopY7nrmwzdfn5S0F7DzEYsPbkKOzajAOOSnuImXZ4NcGcv5WDMoPXLOqpyAUg9xCFI+UQK7HY7CelYza8mY2Majy+hcCMpWg8CZNQdYbGCB6gNRG5KDqVIfiWIPW69+XCuGrMgtvp7tEcOgYdLn9OstMbKaxuJHvbwYnzXo3Lz7rHCqW/QljM5DMZSvO1B7M1tIEmOnClB7SQASZUFtbmWB/Q9p8GYth7ofxHcINmcluyYNAdvY+YQ5UJA2QQpCLDl21Pp0lbpYnJZmOeYrmuLaaF0QgCH53OgTKdJeoI6X2NXXyEqf1EDdHyuFxQyy/guwpnq5JPLgdRL0YT1q/wwJl1l690SY9xtHTep6ib8iX5XDskqyrnfgVgvcXcXGoPA6JcrO6fkdL7xTqDMp4xcvm+lE5fIW0fEXNBcDh0c8UZv0Ji69VOjMFUsZTlPb2139wVDlkzJBNDzBO69TNchAkopFVfGMgGXWB1tDDLB1+RLLFrGzBmAgkLBlqU3HzLI1tr+XM2SNFpTkOjeSRKMhLfZl7mD/KPXIf8TEBCEnr6tQbRcAw3VAgcxAQeosTwHHRcxDYF1PEV0YbDAwkAbJhvqQd3iujjanfs3FsV/B9+x03qc1/cS2tuwYE+/KLB0EI42rE+0QorAbHW+0ovbzCeXp787ldYXv0tICGMo3H0oA47lP2LMm7hFSzhtoV26knWjB4Es+2Es2wO0xAQkf7TNLYTtph+COtlaB9/uMGrtX5jomL4H0767CnyGGtuXdWWBV3ssTBYnYERLE7ey1wohJmOnS1gqEmLUxJP4MXF5fcYKK1GgstTi/jsZys46QgGLviN+00EOWEazh5UiMEZeeoK1YeIll9ehFOwDMogKCRDpiIlFj+RoRPn+WseJTQK+5Oz9G59Xuv+RB46W18dkT+JYBp5QXW0J0ucqh15mGuy1h6WqGreYh0/d+jqGUrKsQVkNv3t2Uyr/8AqPdnPtgkJmHQEAsPsGrcv/CD3X2jRrHckTGr0ikj2sPlMxu6s7wobbEBclTGD1EoirMawtWAfYKawxYDpc3CtjPXepSU7bMBbZsY7MJLGPUUALRd0oHHkzFButLt0yzqkzG70JAdy+s2ZPGUY3pfnpmoJi08F2el/OhwUHZoo0B3lhY2H9S/jsAeZj4yoAT56ZITSk/hh1r18Xb0zx9hmNQhTbLBXWv2oB0epDlnofBmKOF7r0yXDn0B5MooFI92MCHt3/dCAQRFK45cQhnvQsd7PTKfhehgIIB6ZWze8puSsEOm4bPv7Abm+wEAJ7AT0r9a4GMrKe4I6IxRgwlbq6B+uQw3qU3CjsZ8bVLr3JRa5RSDYX5dci8VrK8Y2udtDg168xqnoO6jK35oD0ZAb7FhNrD0kPiDCdShDQ+DHUUsdGAX5KgFgBDhgJMbmlnY9cm/uVEXEvdfMfBuAmHZ8pQ9HrNZJBbREodzenc9LgTU2pjVWM++XYGWEqhIjW3vEovIj18T+VaY2SXPB/PuzRt0jqW4gRftHVmCjZMZy5JMpqL2bPXJYgqJioHdy0vqPKYtnmsmZJFjhBLAVqAEbm5UH9wDQAln2mEvyJ4zF+yXlgnaFvlJ8GYf8rrlWALE9WwjwQDB4H1baUsEspasfPKh3lfjoSFBJj38+4HaU7ZtmINDoVDDREFajrksA6ArBKztR7diPUj/AHLGoQiDGKeDsS08RseRKLQ8zPsEApJTnuW3h91oIjioSq5bV2Po5I3e8r7ovQgEaMdDjPvysx3R22B0vcm4LMTlwOx1Kp6w/fP6TfaZ5y09tjitSxjMXYsZjY3qfM3ssfgjNMFCAzn8+x3VBtjLskkfKVlVW+FjDR17mIAJMe1e1S+GldaooAl9YdZXyru/Sn2WWpWNsYc3+xDHvZ2HqDSy1/U+bXad2IldHBl5Qn1nLn7BNLcidpWgRQB0ye6FB5Mo5NjDRiBgoDHZllvDJCHx1zvxB46Zljpx1Pih2WWMACxMxV9W7l1zgSixfA6Utyuv6ZpI4RAAPGutjFsoDxxgjnSMZiWeQ0OUnMoJiOq2Pz9+Kxe+/pbT/HZm8SivdhfpmdrqjF+0Sy5Kx3MutFjlpuDHsIBAhp7gDfmKoUAAdCoYaI2JkUGnph28X4dco6lOL4djOCn8Q0oW5T58Wzv3QwEMAQdjpk/O57+JQFWsa6Xg6BExrD67ITLLhUyb/Mtr4XzFX77D5bofBinbFX8kxF4qB0ykAvmOS1KkzMfjVK6gbK1gGh0vrdL21KLfVSWDaNK3CXhumY2qphoUqjoHUqZXWtY0o6ZCqyTxfV7s3u1c2V4gRftHW9w8CFiuiJSnBeuX208w9nm8vj6VuX5lJD2yz7JvkXExSfT7x/tMKkg6mH9kcfJLREygi90gz/8A9kfKs/CzVlncjcxfp+og7corKw2D1vG0MXj+JSzGwj8dMnZQqIABF8rqDwOm/ZanK8QRPHsvyRVMXmzs7ex/lLSkBmBEzGI4ARmIEFjRXBHeY5RPlX6N3IXvpdysaRR1IBGjMbtc6dL6uZDA91lZ2g6752M5bQ3KX5VIx+i32t/qUBWZH/PsJABMybjY0AJIA8mUpwrVfZl+ET9tB2AHV2CKT+oXOS6fL8krxqqzse91DKVMrrepw5+3rlAheyyqxSi9+juEUsfAgR8p+TdhK6krXQEy7Aqa6VobDHqFSEByXMexFp9OYikV9cwlQjiY93Nftm5dpstOuS27QkT7V6ZzeBFpKalr820PAmD/ADeuaRwEpbnUh6Yx/wDk2dMw6sqMoJNSk9cobyUg8S/vTZKk9QAERMKuZPFCa+MoINSaPtvbjS5mAPkY9M3lzSY1Xpp0z4MqwKFn3bM7mVYY188AAGhDZq6wL90Ukgb62Vh6yphBBIP4niYmR6o03nplzEYtSOuUN0PMVjXxU/npbWHd9vrvK14VqvSz7YoX4hIyqy6YbmSCGUKJhndXQ9tmPw9QEHfzDfXL0WmL/ISZvhJRUWsFh65vaxJh2B9rwh8SxdM414aUuHqUzN7mpYBoAdLczg2gJ6uU/dTGe4KQ4aVqvq1n8npkX+iRBnP/AGT4xe3JYCCAZmea4y7KiL4HTKu9JJ4BJmNR8ws9mUfMxO1ImR4hJO9iYh5R+6mFNbmGNVxz8plrcd6mJ/KEewbKy3RO5TR6pJbxLaDT3VdiXN2BExwvAEfTMtqet5iP0J0JkXfgGVd9SpdEnpcARANExBsjrf6vqABoh2OjtoRFcsXdooJMQaHsvxvJlVi1BeRisGGwejuqDZlm23MVNTKGir7MUeoxa3soltisQEGhFOjKyARFOwITqLdWx0G917ILWinYB9lXA5T9Munvz5zGcFNdLSBW2zKKg1nHyIBoaHieIliP9p97DakShCL/AGZNrghVjb5HcwqtnmellyVjuYp2oPTu2cfZlktpQZVWta6Xq9i1jbe0kAEmUfP58curKGERF9Y6Hh4JeSKnImNexs0Y7BFLHwJa7WOWMHcgQaop5aiVkbd/uMprFtx/QgGhrrm/yZVXxp0PJErQqBs7MvOsmrrm9nRon2rHYIpY+JY7XksY1uqtA9zMOntzIlGkvsB65Dob15eAIhUoOHiHxMTte/TP8pKNimuMyqNkgRXVvBBl4Hxab6N4MpNYYgOCSemTSLUmG5Uml/blAGl5gfyejojgBh0vyBVLLGsbbQCJVZz0FMqUpfwI6qQ+RYYPHszKf+a9FYowYeREbkit+xM1ZSQa16369JgYgsaxSCPl6XofVeUkmpOmW5ChB/zlFOmEvDGo8PMex1cer+RMbjxbQ/PQ+Jx2QVGlZuuTsAyjtTXM3wkxnDeOuT3ff4AmH3rJ6XaS9+XhphH5CssUXZIHTItKCV1C67USta10Jkdq5Ts5CdLscWkEw4IgwbOfd+mYdWVTkoYH8mDwOlzm2zYUlUlSNef0sRQihR4HsyHG2Ew+9Alg2plmhsCYo4iHxGOuUxP5Ylv2mKQ3JmlBC1blr87WYR9GomYr7rEYclIly62JhWaYr9NjoR7GbfKA6EW3gDxYgz4i5uxhUufGhEUnSgRF4jpk9lgJlW+3XKeC2wDtPXv/AMTnbZ9x1ANkRV17T3EtRdmKxqXse0TKLxwbLNM5IEqqHiIgQTKs48ZZs/cYB38QhT57SuvffZldzVMFfxMvl6Ep5cu0UkqN/r2MwRSTLW3YlkR1cbU9bbErQljK2CMSSYDsAxlDAgwC2l2CiDMq13mRcltcxaPTHLpm8hWJgg+/JvWkanqWDuCZXdW4XTjfVyxZt/voBeiqFQwnKB8MZxttdOaHUHiEhQSfAmL3VrPy59l4cPoJszneyHsQRB8VYQDuPZlIeyyz4l9BgYPHsyG41mY7bcLF8DrexFtirMezmnfyIZcFovR5k3+r48QzDrBJLCWML7eO/kWZLHYQSh7Kf/0zPj6/7Gnq5dvetdCD/MzXXskxiDWBAfMfm+UX0YPA6X2832BKH51KZk2epZw/Ajb3qV1mxgAIBoTKqfYtSUZnkPHtucAVJGTIVjKRxqQRjoEzF2L+mY48RMtUoSO72HbGYzsty6mS+rleVuHRWEtKBG5+JQqLeuut76vYpKWLVIT5I9mc/iqYRT0YSBHy6llt9lh89cZKnJM7CLZu8uT+YPA6W7S5/wDDSpudaN+x0syHNkU7UHpl0a+delGSapkcLGDB5RanDXIdoL6iN8419QH3S+57fwQJi0cTz6Zg0FeYpHDQ6ZXz2VpKk4L0y/vAmL/K62ceQVG388Hjpld7eMqGqkEuQOnjcDlHUqoC/mAgw+DBZt37cpWNIvTJQeTE+QtrxMLubT0yRsTFtLW66ZH2SrZvT3ZabYGV69UA+dweJl3fLpTFex6+NYldYrXQ65tnhBFOkBP6htDs44A7MqUKgA6HEUtuaAIEPgzueff8mYbbWWfYZYV2CDAGfGOjEG2PfU4nyGmM1VSEl4DsbmWk335J5ExbhYn0mHIERsMp4jAVuV1F03icT+otbE/bEQIOt1ZftBRFr4nrbjpbPh9Q4nfYJgosldXAed++ypbBoz4RJ8OPMGOAYqhfHR8ZHblHxUKRMV58ED5aCisRsWlvImhrX41qJRWnj2squpVhsT4anWuEqoSokr1ZEf7lBllFVuuSwAAaHRkVwQZ8NSF1FxKEOwOpAMAA8D3+inMv+TOCfoQVVg8uA30vfhUxm9ncwqvL+3LfhTKk4VIv9LksorOxATKqXtMvYBBSnkwhKa5j18/4r+1lU+QDNe7Js2GrE4qPzAnFOZ8ETGq4J1GPSCTwEAA8TXtteqs8m8wkuxJ8mESkH1VjV1uPmWKoUAAaAjKrDTDYi1onhQOr11t5QGAAAAexzWBt9Q5NFfZJZfY589VwolFSeEldNde+I6HFoJ3w6MAykGDBoiqFUAeB0OKnql/Zk4pB5JCCPMTjyHP7YMJPKvDg1QYyCDHTqyhlKmGi+k7riW5bDskrxH58rDPHS3Hte3coQ11AHo++J1Fxb1YHUHgRyVUkAmCi9mL+DKuXBeXnpfRy7rF9ajxyMsybXHGYtPBPm65CA1GWBx4QzHThSg6WDaGKttT8lnxjjzVLXtsILqZXYUtXjAdj235CP2E5pzVo9mqeYg5AksCSYLLUGlSJfaQeUN+R45QXXKT8+4w5ade53H2Kj/qNpbQYn2jrvd2v0I50pi7Uuf2TMVwHKywjjLFRiCJipqsiPU62kTa+NynGR/MAAGpYvNSI6PUZTdUhBisGAI8H6ZqrY7KiBVA0BND/AMBzLOb6gBJAHkyqsVoF9tlCuylv6WyxK12xl9xtaUAM+p2oolQI+d/uaOTe4qWKoUAD6d1y0iM/LZPkmUVLanf8GWfPYiL9K1xWhYw87nJiVGkfZzeWfKe66fc5HlyiOHUMPoEgDZMfMqUx84nwsZ3byYVKEGJW1jaWDCtiUVV+F/oMrG386dKMk1dvKxCrryB2P6fiv9o+ia1P4npp+oQuuOu09NP7RAND2EBgQYtFSDQWGiojXGGqsoEI2BBQi+J6aw49cGLUIcOqJj1pLKWs2C3aHB/Tyms1IFJ6E6BJigef3L6rrGHE6WfDdgIcN0INbxqrLD8xhxbt8JTjNU4aW0i0QYYnoX1d6zFJI7jXTJpLjtBhkpKEsQaf/wANvc10u4jMWYsZh187eX4X+qttWpdmX3td0qxhxDPN+taAPsSXuPsUEuZRSKk+mzBBsy2w2tzMVC7BREC0pwmNXrlYfLfRttWpeRgF152fEZuPyVDbyio1qeR2xmemih6UZDUmJdVZ4cdWsRPuYCHMonx3n5Ic26NZZZ9zE9AU19veJVZcOyyvFVfJ5Ra0Q7VQP6O/FFncR0ZDphK7XqbYMqyKbP8AtSAQQZrX9LxIYnkf/Bs5/CTUoq9KsD+putFSFpba1rbaaPmUUgtsiX28AET7jCwRW7eO8xE5bub6mTbzs1+BGBLaEppFI2e7TJs7aidlAH6+hbclQ7wgv89x7fgQ3u54VSioVJ0srWxCpl1LVNo9UvtTw0e21/8AnGLHQM1NwGJRa/hYMF/y0TEqT+nequz7lj4Kfgy7GNY2JTlA8FIP/iJdV8sBAykb3C6j8zms5rOS/ub9zuqDbHUR1cbU/wDYu4RGY/iWObHLGYlJd+f9Kb0FgSG2seXE9en/AOwR8ipPLSzM/CRnd/uYmEjWtT02NQmxXWWMr2zG5vz4gBvt4/8AAGKoUAAaA+nfeqKQD3nLzvyZi4/ixpbHcu2/oX5OvlTzN+n87NzeLVbeQT4ldKVDSj2OiONMoMtwfzXHpsr+5enB/wC0xMS8xMbsOcGJSD4ioqDsAP616kfiT+D/AOEnsIgv9XkX+T3HxL0RSdDuTEt4DWjBfz7FNwWt4KkRrWGpu0nzK3t/JlZOvbdULUKmA2IShOtRWt2Pm3B4+gTqNk289Be0tyW8Si8/8zB36NYiDbGXZrJ4EGY5aHLcnikovLfK/Wy1E8mNmiDMc+ElOTYbCrQHq1uhDm2RMq4tK71bz2P0b8kV9h3eWZdhUFJVyNa8/PsbM7fJL73s7HpijVC+y/LSuU2epWH+gzqg2TDnViHOSU5QsbXHo9iVjbHQlucPFUN95HewwMx8DZ/cJJPf2JWxBfwsorDbaUkGxwfAmTcruo8oI95+1AQJjXrWhBldq2ptfZbalY20+NTUpzCxIaVZlbnjxPXJuFaTgePMzGo5fO/TLfgnQZJ4pob7fNDnJqDLdCfVEfLrWfF17ES+tyRL8kN2E5fgdpRjl25N4gGut1pqQPxlF4u/HXzAB9ey5K4LVMBHsszKq4MygwOrAEH2llH5nq1f3j2s6p5IENqfuCxCdA/+HHwZe0qxXPdjLB6agKIGtJ7nYiUop3zj0I8AZbCjSvx7rBu6ICNQePoXXMxKrFceoqnZnFdeBMlOFiyi8qQj9MxzzCSjFHl4K0HhZbiKw2Oxnpsh2JW4ZR0yk53oImFWvmfD061wjYxVtodLEtCHTHpl79PsxERGus477CJUlY0ohVT+BHotHkxco1AB+8VgyAj8j3E6G45Wy0sBoiWqjAdSQo2ZZbbY3CuU0LUJe5e15XU1rcREBCKD+B1NOVZ99oEur9JmUyj+SnvdwiljBrKs7mDHoUfYIVU+VEtxldlcdiOmf/wnoP2hxbUG9zEduc4qfKiPRS/lBBh0Ra0T7VAmdb/wikVUiLewRx/dK/SFPM+ZRRz+d5ZSjrrQg541nGI/MdCQBuWkXMJTi1rXoiGmnjx4CGjgymoDpfk8PlXzEpZt2WxaTdohvkgAA6Zqbr6BivgyhKWBNhnqYnADYIEfKrBHCuXXi0fZAny7gUGUYwXu3tfRVgR21MJGQE/0VtgrXc9C25i5OgYMKqWO1Dg+REZXUMvTMfiupVhAptzBhUy6m1e9bTGvYr8/W57XvdO5G4MC38vDgePnhe+o8NxG5DfTJv8ASAi87n7gtDhKYce2ohuUpykc6+jfY9lpCt2ER7BYgJPkex8lNMEPeavtQOHM9LJTxzj3WgL3YNKGL1KT1ZgoJJllz3EnkdTC/wCYB+hff6QhzLZ8bbPireIeVP6iK3Wyxa12Yb727g6ExjZY3I2fQJ1Lsv8AFcey8hfnO4m+C8vOvY143oQ5FidmYQ5VglVwtQEf0ZGxDSqOXLQEEDUtXkfMH39jsSlALujKDAoHQ3KG4xWB62n+IYPx0LBRskCdj7cmwpWYA2izSuka3BMgbWcVYgGL4EfH5Wh+Xsvt42FZRokHp6ac+eu/W9wiRihTuTMRnar5pdSLllFApHXJOqjKuJv8e/Ju7BUlVArTv3MPHs39zdbGTsGlB52FgsucV1k9MFOzN7c7ykqAFaj35Vjmw1zFq9NPaR6uWVMSmuv7Vl/ZNmYbDbe28B8tBLrNnUp7rtvsWAG+7/EACgAdM0EssoXQ6ZJckIkx6+K+x7WLFE/X3SmgV7d2ibyS3LfCKoUaA0OpAI0ZfiEd0mj4hBHSq30j43C7s3jzExLW8nQiUV1+B7rgTVZ/qYJPA/0JOgTAjZPcv2ijioHTLXdJmFYhrCDo9HO1HJ8ey1TXz/Kkygqal10ShVtezrlFQomE5Js6ZNJtNcRFrGlHW9eNxCCYd5ccD78q7gOMBVawZX/NqJ8E9cmzhUZ6XdUT7jK0CKAOlybrbQ76lAIqQdH5cDx8z0b7vv7RR21+RMJOAf322rX5ltodt9+UppBVWcQ1Vnyol9OqjwlAIpQdLrWr8IWjm68jdZ4iETGCjx7yQBsy+9SOIMRQBsSvjyGzB465GRo8FhDM4A8wYKfky7GCfa0Qmhw0V1ZQwP8ARbhRT5G+l5G4pAbUqPzDt1J0JdezEgdgIKshhsLAbEX5zoymzkOjD+IxMrG2HS9i1vH8alWQ1ZAf25BOxNb7bijQA6ZGuBiKnIFHifb7bCHd21MbrsDyY+TUh0WjuL7fMpoUeV92W68PPcSpOdqWD3XWCtDMOkfeYQCpnAJwL2dt9b9G88fIExxxpWZlodgo6VACtQPAHtywRcCGlfdF9x8Ta23AieFG56yEEg+JVkJb1qorq3x6XjaTDClz7cocD6om/m3A62hagPMpqFSAdctCRzExXL1DpcXOQOMX7RPWq5ceXeGxB5M9YHsBLLUq8eZVS13z2wAKND3ZIqT5yk+Hqs78oMD9vK8Wuo7Ji2VsdKwPW22/1eFYhTMI+8RLsoMAVgII6N9pmFrgevxVrb4JKjYUHPz0ty0Q6Hczlmn8CHJuq7XVxHWxAw6X3mnUot9VNke3IOkmEybK9bBtG/1MXtevuyu4OpiDVI9m5bcjtxChpjVkAuy6J9z2+jkWbmPbW7nQ7+4nQJg/+TbL6U9LxEfb1qV8HrYwtdjvskxU82/QXs7j/Mw+7WN7iQO8dza7sZiKHs97kKjERfm5De9zFTiT72UMCDPhaf1Ho4nawVhmUGDwOjnSmNcnLxMZBbZ6vTKqDpNN3/PGYh2n1LGZB8qcvaewhst9f7vzKlIHknpdUBbznfkDKz83XJt/4CVUAkc54mWBtIm+/FtRPt7nctXbSv5WCjpfU3LksRWe4DXtvO7QI7aA/wBiKdqD0y/5LRalRR43KD30D7L8g8uFcHFVA8mUJpQegl2KbX3zgxbUm/RbfpxHVwCPbdkCshVG2jDiSdd3/ExqDUPb4jK2Va2j8olacF1snpaWdigQeerkG+wws5U1r4hGiRMaouWlTMl/j/cB2N+zJ75AH6WV/YvuvPCl2iDjtjERrwQxIEGFWD5Mtoepudcos5ezIANZ7zDAFvtzbPCdML+bNHfnpfZ6dZMp9e5HX8GVVipAkPgxmUb2TvzH+IZFKGNSKgvP72Mat1+c2QPb+DKMUAcn8/QyxuuIbbTxTtPhX8eu0OGD5saU4rVW766G99Qno2dn7N+OlgJrf/RmEhCE9LH8ov3GY1PpJtvuPS9zXUWmJaDZx4Doyq6lWHYyqsVLxHTIoNySin0k9uSPlEw+Ifx363fynmONXe3KuCStHtIRT2iKEUKOtr5Ic8ElmRa/ycdTEUJaVb3EgAkwWKxsczEReJf3Zdx5hBKaVrEv71mBdX09SG9V9HzKdJSoJjZieEG58a/5rlGYLTxb2HsDE+cs/wCSZigh7PdeCam0Yu9dvMxqwlcOTSDovBlVxHRxtT7LR/CYwBOziYhO339Gw99QkixSvmKdqOlwBSWBQDoTCflT0t/ltB8gYNMI/VJA8n2nHqL89dcgkMABC3AiUshtHQ+I52TqDdfzGyfFXP2WHm7DezK1YaifbHXnY3f8Svkui30L1/iCXDtsSvfBd+ddMk6UCANy7mUoFBPRnVBtjqW3vd2TssFXcBd7MroVe/uzBxG9SsHsykiIxKAnz1yrygASUrbbZsRaQCCe7e68cqyu5RV6VYXo5AUytiLuP4J63IKbCd9jKgVotsPTCTVUvTdweYdvNT7Mx1N8QAKPddr0n3Ds1IIg0oHRuyMZWNXb3x7+zJBNcw/53svuFSyw815kd+mLaK7IX0V0PMvy3SzSxEtyWBf7IiKi6Xq9ad2Me/06lFUN5GiDsyupryfmlvGmpBoExd8Rv6GexCgTBGk9xIEtvcdqkLQvkWV/KnGY3q8Pn6MdAyi8O5SXZfA6CzEcMDvz1dQykQ0FPnPmJlJ+TEsrfw4P0cwDSDnxmL2yut54VFpQWa0OepIHmWZISNzyX0sooWlfa9SP5Eycdk+cGUXraPYzhFLHwIbmuU8jKMXkx5iKoUAD233eiJjA2WbI6Z2/QlQ3bXy89U7cm/ZiVWXtExKQJZSNEgTQ+9OxB8Si0W1dT4MrA3b58zE7GxfdldqGiAaH+pzuq7DxDhhwD4aPh6SV3WVkkCVuLEVutg2jCMgA4iYxJHf6BhsDs3+Jv+Kuz+YvgdMhtAx/tmLV6dXR/tMcatBPiVH+P9UgH6GRsNE27kmVKOQ6N4MYANsmV1Iz8vM9NP1BSgM9NZoARtK+hFsVTxaDx78xTtSBD9h3MS0vX0ydcRsxHDMNRfEstSobYz58qyLhf3tEqRPA9+RyFRIEDc9fjR7yv7R0vvNvyVxMTkAbTERaxpffk49hYssAyEPh5zzT4QwveP5oMcBSHEZryQfmEX7RvzqZJIv+2ZbgVKkA3oCIvFFH6EyuJdBMD/8AV9maAL4vge6wbRpWBzA/TwdLF3S/+oOJ416PnzFGlA63EBe8xdev1tsFaFpba1p2ZRR6qSys1sVPT4l2ULKcVQPngAHjo91df3NHzq419jpxgRj+JThlu7yutKxpRLHr+KBYxCpUFTsfQzv5QmKVNS+0nUUm/JgAA0IfBlFji/j0tOq3P6EXnbw4r4PmempHcRgaciev6joE8fn2NiUv+JbUcc9mMxbvVr+hmVc0mMGF9fXO/kTFJawDrk3m5uFcqwyR85iVpWNKPfl/y4mq7VPjrfeKknqPaUHOVYgR+RPuJABJmRclkouqNcGTQf8AnMnKRhwE9RVep4L6P/sE8iWfJymN/KU9b6wLj+iJiEJc6dT4MDu5fx2aUEm6w+7N5AIRK+Z/4yhD5breihxMMkM4Hjq/2tHIO1Exj9BvBn2OwB8mKgNgaDx0yxtDHX+EGlL7qUnpZ9pjEShQbSw+ocgoxHouYlxPY1OPoZMQaIla/wATlvofBlx8jcxmI0OrOq62ZvY7SzvYJVw5/wCej3orhICD4PttG1jKxs4fiVqqoAo6ZRQylOPDpf8APfKuAUcZsTkP3C6gEkiU3i12EdwiljFZXUEeOt9iga33nM7AKyv7BMlitXaYqVBeQM5L+xNich+5fla7V/QtAKMDNWKe3gGDuBsd+mVsBGH4aW2Gx9mYyhrl6ZJG+Y8iYVZ0bfZnCUndVZ/x78kV03LoRCCoI6ZLqtTgnuRMcOXVPZljagiYnEv0ZgiljLrmuMqqNx0IihFCzJoFsurFba6C+4eHMGZcJ8TY4+8LD3JJO58up3O9CYtQKBj0utFSEmPwKqPT7tFACgAewsAR7M0/JMMEV+2/l6TcZiJxLHoYgqW7z3PS7vU/+phqBT0zK+VcwmHQzfS+sMkwv5x+gQGBEAONf3ikMAR0zbBrhMGoBOfTLckekkxqFpX2Ag+DCQoJJ0ICCNg7HW8Iazzi/O9evO+l7lKmMooNp5vFrrT7UA67G9fn2OvJSIcJidlhPgHhwOTSzGVIyqCiwYMACgATKEpBFSdcu0AzEXlbzPU+DBx52MfOzMQDTH3ZKg1HcNn/ABUzE/k9crXISgutw11f7TAdXOCPMxx9BvBjIDb3HaegFcOvXIAKSxn0F/AlH8odLSAhJhKgFpisGY6H1S9a65OB9DIMRm2YloVl6MCQYaCHMC8DyMrzBGzBK2axy7RD2MNhNjn8QMAyP/mfiW7NraExbG92RtX+QTGyeHyPLso+K5UjMeZldeu56MyK9nf8zhv5g53PUcDTGcbLPJIE9FFU7Mx+OhqXAGtpXeKAdT4x/JqjZVxTxFDl9kFjES02jadh0zOzjY2sD1L43K/SdiY9rr2KnUX4coS++USwIO6wHYB9+W6CsoTA/Aqe5EqsSxdqelmuDf66YrBLNky/LBGki0WW+TpZWgrQKOruqKWaX3eueymYdm6+HvvpF1ZED3YnYifHQCzIeU0ioey+82njUIjWVsNJEsPp8nHGXWtcf0spq9SwLKqlqXQ65yDQMFNp8I04kHR7TXSmlrWiYVYgrQIUA7RqrsZ+SRsuz8VysNfb80WpRr2nUI2CIgAUAHpm7JVQJRfaAqel7m/gZGz9hhzKJabDWDXK67/XRmTpksBUw/JExLjX5+zrYlnNnCn7pSzFByEyFLUsFlGSKU4ODBlUEffMrJ9T5K5ioyJtumdzEw23T7synmOazDvQJxdocqn++ENkW9oqhFCjwOmSxXJeLmWiG65WZ4mVYfLRsrYPeYX8mXDdLiY2SiIFaeoh/MfJpQeZfcbFmNjFCHPTOP2RLxSgWHP/AEkGcv5SfGVmUFjkMSfoZ2uCRDq6vrlVvzFiTHy25hX6WWLWpJj212bbwZhJpOXUnQJj/PYXUTCcsH9zKHUqfBnoorld+DMVtM6dPE5PYxYr2mMXLt2+XrZ9pjnixMxLOX0D4MdxsgmIeNqAN231YbQx0Adpi3cwR0zX7KkZeadhMasVp9V8Wmw7YQKAAB4HvsqHMtAD+jFb5+JEr3x6Ebl1ZH7MGNYT+hExwsFMevdZUGDGt/AhoJAXhAPlAMfHVjuV0LX7nQOI+Of0DPhZVVx/HX4WqDGrEGPWDucE/UOPWYlaJ9o6PjoxhxUPkwYtYgw0BBDv1IB8iGmo+UEFNS+EE4r+hGRG8qDOCf2j6DVVOdsgMNVZGigioiDSqB0tOqnP6EMxKkLNzAM9Cn/6kiqFGgND2EA+Rv6RAPkT06/7FgAHge3QHgQ6A2Zfe1hI/Erqe06WU0rSPcyI/wByAz0av7FgrQDQQQADwPZxX9CBVXwAPp69zIrjTAGehT/9a+zQ9mh1tort+8QYdH9kWtF8KB1IDDRGxAABoe+3DqtMGBTFRUGlGh1emqzu6AwUVDwgluNVZ5ETFpTwsOLR54RVVRoDQh0QQfEswFY7Uw4Fn4tiYH7aV41aDx1tx67SC0swg3hoMOqfA0R8FJVhiqwMH+hamTe32TT1sD6O2iElRsaPU4urGLCWi+rurnjDda/yk8pRQzfevaAAAAeOuTcEHGEkppa2lFvosEKe/LoDDmPMSwq5JMGdLL7rYqvc/CIvBQOt1ionebrO9mYhq3pfoGDi3Pl4DQvQndF2Yh5Ih/Y63VjyBKyaLdnxDfT/AHiW2V2v3mNWYBof0vBNk6nBf1OI/Q92v+xydmh9RQDMNuDsv9OzBASToS/JNvZYASdDyZRUK0/ptf8AhGhOCDwo9pAPkdCqnyoP0Goqbys+ErnoIF0BK6kr2R1MFDts3NswYdYMOHpg1bfQtFz7Ve09C4Lw4iPivxOhMX1lGnHUjYl9Vv4gof8AIiYrloiBR/4ff2os6Us4YlPIErcWIG/pfEvte3/8J/gCY1ARQSPm/wDRGh/0PIfsf9hYvNGX9iEaJBmJ/PEH9Lfez9kPaaO+IlGNw+ZvP/qQnXUkAbM5NZ9vYfuKir4E4L/aIBqAnfj/AK/JThaYj8XVv1AQVBH5H9G7qg2xl9z2j5PslaF2CiVYyJo/+mtOLCdjhr6d6F6yJUCoBJafEkT1S380yp+a+D0vuaqfFR8tpQ1hPdD/ANHY3Bdy3L0vywZa/kz4kn7I9+UJ8ZeB5EXNu/JgzreXszkPMP0w7uacOrglGCnRgyslD98qLGtS3n6t9/pDxsmWMS6mw8ozm0hEGh+pRQKx9Q7I7SzJyKiQZTk3E7ZohJUE+y/Ktps1w7TGyDdy94vdLSjrPjU3riYcsLy2hgzkiurf0QtQ+G3FvrZ+Hud1RSTBl1lwPoPk1IdExSCoP0iQI+VUhgyKdL8/vPaJk1Mu9xL6X8PEursJCt/4c3iXfkyoE9hKKBy2TvrcqsmiIECkxOAO9RDtRCXHhdxST5Uj/oc8/IiynETgC6xUVRoKBMztxYCE/MEPhhFpqVdcBPQq0QEAllTUWqW7j2ZKBqH6VWmp+QlFIr229lutlgFj9h5ifaPpkgDZMszK1j3MxMrqewyjGFX1sytTp4yEAsuwJjHdCR3vOSoG+PW9y1rKpmPX6devfbSGs58pjDnezQgEaIhw6DBielshpTknYV4rBhsfXvtLk1pN1heKfrzMP739r5Z/FTS53tCBl494qcclB7rspKToiX5Vx/BQSxn2OYBlf2L9GywII91zuPxDhb82R8L5RxaLlWU/LYspt9VOWvZkX+ksfIvPYmDHtJHaNiwg1DkjEGVtyRW9uTYKqjEYleB33MrYrcncnv8ARuuI7J5hNz/dZAzdtWtFyXR/mYkRL638H223pXHybW+yHMuEqyQ50fdZelfkz4/9VQZogzE8OCsS+p/D9XsSr7jDm0z4qj+6DIo/vEGZj+Oc+Ko/vEF9JYKH/rj4l3duP4muAPETEV9Mx62/ZH5ntqOukJmKSaR/01/ddSoEnX6MHgdCoYaIB9uVT6b9MK8MOB6k1hteSGg8fStyUqltrWse/aa1MakvFRUGlH17051kCNf8hXXeYgK1dbHCISZQAX762YBoe/J2b+IaYSFHcey6gWrMZzVYa3+tdaKkJMxkL8y47GX08gOMxquDt7s0kGuVnWQhPuIB8iZdYsqmvVUL4YRftH0GYKpJ8CG0vZzPgSlGe7mU7dclS95mI5HyHrl2mpBqc0fsx7ymgVj9nrdiiyIOKqP0PYSFGzMhxYQeUV0bioiEJco+hkuyppZXtCdmU44cBzLqaeO2EroZuTJ4nzAn5NESi0WJ1vt4LOJBJJ2ZRij73jUVtLMWY9pQipz7Mq3gkZNje4iXED5IMUeTLcZzZylYHxKdcpdwKOWjPTGz2jKAwmkA12gSszEp0Sf65uwjnbQHfaVAKgE3NxyvHuY9vFgFHmM3yktKSDWD0ty+J4oIMi2DLsiZbym/n7Lc0g6SJdc34LGc8njvWpXksH+ZpXfXZ4PS6301luTax0s9W4fh492R57gSnJ8BmgII2OlxYVsV8wZN5gyXWrZ8xcm9/wDhuWvce3ErKrG1poDsfRybGRgINhlO4PHsssWpCTCb722AeMGPevcIJcjCteSnp4O5i3oN8zAQRsS1kF3euPm67KsFOVb8xfUtTJp8sZj3lwA/svy+PZJXRe/3uQIxY2kVuTHsDJojRBlKGx9RMML953MqshOaEgiUWX+oPmbrk2FXOnIMOS9QQh+cOTe/2JHTM8kmLmn8pK7BYoYe895fj8CNSgpoBXB65z+EmNTqwN9C7gLxzlL1sTxPsMsc13tKHLJ3+q+7snj+FgGhMhyi/ZsGYu/dlDnZUkQH4mv35e/RgZuJYdiJQ/OlD9DM/kPNcqdj8CUfya/9dctAUDyk/wAYN1sC32dn7CUUIbSfwv0cyzmeCzFp7Cwy6hDogd4Ef1U5EdmH0Mp+Nx/1KrG34i+BCAwII7GAADQGhL3KWkSjYv0OhOhLn3aJXSbLe/gdcnfCWD5dzGdnqBbo7BBuEm1iTKKjZb38L7BQot5jrlnUoAsu7zgv6npV/wBoj4tTxMJEMChfH9c/iW+YrnegNxrbV0dQ3merbASfDHcFe9cjCqsNGIAFAj74mVVNYx5z0k/UFNQ8IJkJUgD8YrDYMrbkOmVaw+QTHpBO3EAAGgNCEBhoy9FquExawTz6ZFbWJoSmkVr0IGvAllBNpAlBZLDWTsdGOlJgLa3Kcc26ZzAAo0BoRlBHcR3dj+pQ6svb6OVaVIED8iFg9l1KXABoBroe8sqVncBu8ZSp0elGV6Y4mC02udmYtHHbv0dQykGPqjiB+4PHTJJFTalZVRzI20sutc9yRBsSnGd+D/iAAeB0vB9MxHZbBz7QeOmVUpBaU1iyyKOIA6Wswa0zCca4x3VACx9954gGGwtcvE9D2EvdHfT7BEor4J9CztcysvIPMNADZ7bxzuaYwKkD6mTc3IIkx6iibbyeluuPeY44trnv3ZRPr1yg8rh27D35famHTLKE4VIPoZrWCDaqD4BlI41IOuaT6JicSAqiVNyQGE6UmIF+f9TC7K8svA3xgybnafFXgmU3Lcmx7Mq80qJWj5LwAAACZpdOEqVS6EN+foZCfxWM3phF0QNdbVHqlifxCNXoQYvgS5tIYSeBJmGSQZTctpYfrpepaphOWqyDMMuBo9Ms+FiIFPmUVrWvTkP37cgDcxkAvMe9UnxixM2uKyuAVP8AXv4MtHIxBqCpWUQ4aEz4AflzPQrVYxA8d4o/MrO16FlXyZZlIkOc/wCBGZ7ANtuKNSkaXpdVtucY277NoSvK+UcoL6zGWuwdwDAABodbLVrGzLcwgDhPXyTKGUc3LjZmMndmPR/tMqZQh5THYNWCOh8S48tyhFVe30c0gWyh6gfdfcKVgvyn8CazeBiKOHbuYlAtp+YfNHotTynWvLsSVXpb0yKOB2niHIrrUcjDm/hEj2W2dmeAcAQ4ML7dfl8SlKN7tOjFZGHykEdb/smudoAPkwDQAJ6ZabExEZOt7Hk6zCTR3HRXADDfvvAFTzn8vJRqY13qiOdLAguvIgGgAPx9C4AXAi75pQpGyT7btfEzEcm0r9Oy5U2N95iDmObdc3lwGphOefH3ZB430vAdZfY9j78rfpyxvxqVHdaf6+hn/YJYxNaoU/0Yo4qB1y/5UFvAgiVENWpEs+x/9StTsNy0I/3HgxPKUY61ziv6l+H5dIgepuamUXC5ejuEUsZ82VbK0FagDpdFUm9Dx+hk0BwWEFSFFO5i3ea+l+QEBA8wsVALHbGBwWHaL4EydBIGUbDCYnapyJSyHuo8+ZuX2+kASsYB9keJjkE9Mywm0QbK/oz4phUNJ3jW5T60sf1wBs8Yl99Xn5hKb0u6O6oAWOpc6MfML6b5e5gqus8x8a0GGkyiw02RWDLsf1z/AGyxWY+dCfaO0w7X5GvrZ9sTsolndeI8kymsVoAJdb6ax6nc8i8qxB5aGmojXGZCcAoSVBvzKvHWzFZ27PoSzFeuBHY95WXDfKmotg0Ax79L7+GwJUll57mJjVJ4E0B+IUXmx/yZjEq+t9G8GNWvJuTdtyjQrGujeDG4qX799ygHh9HI4c9nzENdjqfbflWJYa0Erqe992wADsOlpHrsUOjMUsattCAwIMswfyhjKynTDqGZfBIgdhvR8zkSdmLbx32ESq237BK8Mt3sMONSQBxmVjN5WVlk7r5VpRkC0dM7magBK306JwBIPXLt78JQCPz1v7O5mEPk+gRsES5B6oSU+ijzLtdAAswR95P0bq6UczD8H5t+x2CKSZdYXAmFXpOf07STfYZVbfTvis+Mvf7K4b8rx6UX4p+ziV6Dch2JiZZL8QntybP4qJC1a2IB5PvzH41RzyRTE+xf9fQyVBrlbKUKOSIhBUEHrnHSVwcuYC/uKNKI68lIgQspHLwSJhV9ufsPD1bBMQ/OwXpZc72lJigJz3Oa9vmEN1Q82LMt/sKGUF/V2fE5L52PoW4qP3HYyzGdIlWVK8TvysOzLlUudShGNo6ZQ3TAOwBEQH0D6Z/MxqTV3Y9LwhrPKMCa/lHaYq66ZC7smysxldm2V7dGVXGiJeBWwEJK/Op0wlT+oitGVXXRE+CQHaxKFQ71NDpeuu8sCkTEuIcJ/XP9sZwux+YDymLUKwetx7Tk5fUrUfLuL4mUx9RRF2zKQYvgdMruwglQ+XpfeKYDsdGQMJazA8AfBlLFmn4lrL6pEwyNuOh8TuC41/yMw12WPRyFUkwBn7sZQQaxrox0CY4cgkpKTtB9HIIVi8qdX4kr7bd+vbMIk1dCdDcssYO68B3MxP5A6HsIP4t2j4Jj4C/8HjYt6fiGi4AkoZw7gEwYC/l4uLSo+2XXLSoinkoPXK0lhIPciYP3v0ymK1mY57+e5PXMA5zCJLnofBlzhwf8GYvj6OcjeorCF7FbRA2It9nIAykaX2m6oHRcQEEdbfnvMxafT31Zgo2TL70tTQMprNzBYqhVAHgdXtrr+4xSGAIOx9PJ+zRfjFCiyoe7N/mzFXbAke/MBNMs0i8ZWNVoP0v0LEDVkR2+fhqYZ/hdctyxCCYyA39XpYO/zTDVkVgerHipJM5Fm5EeTMZVS8gfqEQYdh8mfBPHxLQQB3E+Bsi6VNFSCISrroAw4l5H2TFR66gH+kfEI+Z++yTMIHmx6X79M6nLvqYTd3SGpOW4wPBgJuwbXvFsYdpihvJ6ZBAuSN82hxHcysaQdczzVDwAMxey+7IPyQnZMxe939dYQBHUFiSBFb5tCUN1vbQgO9RD86dMmnkeUBZSIl6eCY19ej8wjXJA+/tBMq+wQy5bHtOxKLzvg05r+xLMgDsncx1PFj+Zi0EfMel6FbT+jKn9G7c+KoA7vDkmztWO0sO9zD7N0yCBWdxa9pvlMWxSOHS5xWhJjM57mY7qy/Ry33ZpGlXMOCT2ERkZdqwPsy6S2mUSu2yiDPP5rj2X3fah4x7iw/ImI26ulroiMWnII6uspuS4dMiwJX57mN3PncpsrdBo9Muh7NMkpyjUOFgM+Op/TSzNThtJQtlxLGV1LX46Ztw1wiFQ6HxFZWUEGMQoLHwBLXS87Ew3QHXRm4gmM/zlgvaY2T+H+jlVF0BHlZVwNplNfq2kwdh7D4jU2hiCplAKpo9LLUpXbGODv1QOxMqyCj+e0OZ/ZXDmXjyojG+5O6SnD/NkSpKxpR7Mzl6xmAx4H6TOqDbEATLsR/DQ+k5qCWEEQDQ9hOpkP6tpIlVrVuvvzbRw4SwfIuvEpYNWuvo5FTfekqyTV2ZIjo42HEuu4JtY3JwHB25MxqfSTv5PXKpLfOJXdZVFsRx8rAzYmbaOPARmbgv7Mx6fS92QD6myYrfxax+OX0LLUrALQEEAjrfYqqRATzCoJWgQdCNiX1cXldnC1WnmEgeZe1TugXzLV4vqYwIqG+mXTzHKDkpBJlTq69uuTrkktMxVArB6Kyt4PsySNASwFZiVnmD/AF2TsrqFO2oEVZVaggOxvpeuyYE0Owgb5wOJlb8ljKGEfFjUWkxMSNiqPAhqs1pRKeQ7Ho6BhPhWUdjDimLi2fhomO3/ADbcA0OjoHHeWY0XDMSjQ0Y+K2/kCxMU+SYJbSlvmfB1RMVEfmCeltCWjvPgq4mGK32HP0CNjUGJQn/CfD1d+0qpSkHj7WxaXOysTEpTwOnpV61wEStE+1QOjIjjTKDPg8f+yJRUjclTo9Vdn3oDHw6JVRXTvgOrVVP9yAz4Wj/6hPRq1rgNQAAaHU11k7KiGmonZrWaA6CmpfCLAABoAdeCf2iBEHhR9IVVgkhBAAPA+iyIw0ygwKqjQUAQ00nzWsFaAaCiNTU3lB72rR/uUGABRoD6TorjTDYgxaP7Icent8g9t1QsK7YwYVEfDqeIgReI9rJyUjZEOFWfLNPhqwnGU0LTvX0snG9WDCyZ8JlTGxRT7b8MPspPhclIPie66efCXSnDRdFvdbaKl2YUvydvHrtTuR4lVnqVq3vzASkXJetQIM8/lIM21oqWuT+5RQK/ZdQlq6MdLKn00rzCh03iXtVeo08RlUDS/MJXTZbaHI0IBodGUMNGW0kCY1opch4HQjYIjWqPBllwYmVUvc0RAigCWjdbCVtZQfPaJfU/hoXQD7hHy6h4Mstaw9oivd//AAZSnAf1zpzE+EHPZcwVJ+p6Vf8Ab10DOK/qcR+v/Unma19Ioh8rDj1HysWipfxFRV8D3W0paNGDEE+Ci0AeYO3sIBluJy7rBikHyYcVwSUiYzH7xFUKNDo45KRHxbQYaLItZVhyMXiLtESrEO+8rrWsaH/vAqp/ENVf9sCKPwP/AGUzBFLHwJTelwPH/wB5kBgQR2lNK1KQP/CG3o6gexdhjEveHJ76EqsFg6PeqnU+KJJASHJYKZivY2yxJ/prsv0n0BFy6/D/AFsk3p8yeIcu3SmVZblwHHsvutqsH9kOXaR2WY/rcP4v9JbelUsy30Cs+L7yu4P73cINz46UXesvtMuuFSyjJFsBG9e53VBsmLmoXgOxv6RvrDhJdmHwkXN8cxAQfHua2tfLR8hVq5iDOSVZNNnZT7/iqQSCYjo3hgfa+TWj8I2WglWUln03vrQ6LT46mJdW/g+9rUTy0+Kp/cW+pjoNAR1ZlUbJAEFinwZsTkPG5sfv381/f/gtvkzZErsddiUIFWE6G4bA7MROyCd7O0pQImh/TWlw7E6grewiAaAH1co6oaKNCdmBAMps12MBBHTKG6jKrD6qf0l2QqAgGBTkpKMUUy6hLROI7o5+dfExrOa6Pke0kKCTLrww3CCF7iYWuHsva1U+RNmE5z/h5YbCeLEnUw/vPtO9HXmGzN8elLBby/i7nDg6Reyj6N9uvlWCl3dHSLUi/gbMvoWysiUu6WgQHY6k6llyzhZleBpBK6Ai6J5CWUJZWRBRbVcBr3ZLt4WG1jsETC6uwRSx8CW5T/iLS943EwKpdhMneuY97VGAgjYPb6GVkHfBJVS9xgw0AltRqOmmJcXHE+x3CDZl+Q57LBzdOyFp8GzoCBow0sa+6aYTBs3zB65m/Rig8uTcgJYQzclUgQ6biebQs4JAcytrGYKWaIvFQOtlgrQsY+Vznw15Hicbqz4ImLeX7N9F3CDZlmXA+R93qT4yyUWi1N+17FSHN+eDO/aSq9LfdbclQ20+LonxVA/MVg6gg+4nU9Wv+8QEHx/WHwY7FiTOLt4EU+QV7gykmOQFMVQOw/cdTvidiV9jKnDA6/prKK7fIiUpX4+tl69AyhebgNHwx3KGeqD9w0ZRdoAdLSAhMpJe8Hj59uxOS/sfVc8UYwnszfkmYdfCvrlUA2BuXmVOa7x7c28P8ixMUNUCZWR6hLdwJioEDEH3WjVth3rvMJvI996hxxJhJcD9jsJWSUXf0GYKpMdSEL8/JmGNUjrlrq4TGJ0A3XMuKfKJi0rZ3aAADQ+hZalegTFxwzs7mNSQz/4MxAQO/XMdRURNMxCyhOFajrkVWLYXQeRMFzsj35Nxq4qPJlo5uAO7NKahUgXpenOoiKmuwtAMoZjXpvI6bltnqsSPAlGOLPmaKqqNAdaaVpGh1zbSPkmKOdezDUmta7T0a/1GxaW8rExakbkOtritCYHDh2dpiIrNy4dLqeYlw4tMS4WVe9mCAkyy03nv4Epp9Z/8RKakXWpk0LxLARGenuplNwtTfV3Cgyws55blOJsbaNg/p4a9eD3BmNfzAQ+fZfkEbCQGyzydiHFLgS+lUEqtsoMVg6qw/I9hsQeTLb9kgRlJJImA/dl/rLSQh1Bs6JlYIdYR/FeVmZDAJESx27DUyQdiAjlqU9bbhXBk3t3CT4wjypldyuB1yRYVBRol9y/fHy9CNlv+5Q5Ze56WWLWNmW5R8JOd2/DxcqxT3gzUisGUERgSpAM9W+t2UHepjPY+y/V3VBsmG++wkoO0em9u5i331aBlWQLPflDlUZh/z+mTRzTaicFHkkSjJQfJMriaDKG/iqPZZkIn5jNbaT5MNLtUPlOxKMrgvGyI6ONqeuRksHKSvKYv78ztjmWFCq6ET7V65Kqyd5TpnLQeB1ybAlTTFo5kOY3gyxAOWjMHfA+60VGwj8kykJz+X8e/LchoictfjvF8D6GW+lVYg5MeRJ1KwFRQB1zk2sxnIsXrfYHMxP5X0CQBsw//ACb4o0oEv72TEckuD1yl+dTKU3YYPHXJbSSjtfX7807dUmLv1x7CFNl3+zMFvK9MklaSRBZ24Be+pRsUpv35sxDyr3GtrT7nAgvqPhoCD4Psy7SrBZ2dh+DK1CoAOuUCHMofhcvvy37hBOXEa12JlVa1oAOhAIIltfBioMwezv0J1LLSXeUIbnA/A631gA2AQk9nHkSmz1alY9MouE+SAAJ4mGnydLUV04kS1OG13MG//h1deSkb1BhOfveX0cB8rQMQrf5mCnfn/WXkiuC0k64mUkl5fpWJgIXWjHf1COcrHcdzMrxF0DvUpPS2wKItT2v8/iBQo0BLq0de4lZ0xB/BlbhumQdVGV7YcmgxzaY2EkoPBhWfMJ0JbztsJ3MalFG/JmpkUixJRUsA10btdb/uYvR24qTGe2zyZSAK16Zq/IJj1cVHvyTxrJmGSXPW+nywE0LCR+RBT27tK14Wr1yXYLpJi0hyxcQAAaA6ZtY+QgTHtNVoB634/M80HeVY1wtUlPfnOoq4T5Sib8DzF7AdcnRriM6b4yh+dYPR7FqGyZq69+LStBWnER/tMr0wbkZh9k91rLtmEwx35cvfmkjhOTVMrE8hFIKg6+hld1Mq7NUf37Mw6oeJWUtSCO3BGb9CAJYGOtNKslEpmsyxYaM2C+9EPNZXko4Hsyrub6WUUilel9i82Ewgduet6c6mErsastKbksVejMEGyZkWmx5WSLU17725XmYWvUf2Ox9S3/8AMzFP8fpmOBVxlGuY3GsRV2WGo2dVFz/2kGbXuI6MNqwPXKP/AMmJlWIOKQUXWnkyy2o1PFvZUIUncov5AB/u62uDe8UH1a/9+zN8rGC8RoxCCoIOxr2mOw9YnyTEHO6sezNTTzGUhx0uJCGFwynYmEuq+rjaMIKvI3MBvvTpbZAg/cr+VR1yQPW0fE09L7EpfnWrezMg+xph74Af1mWdVxWUNrUqbjYJlKITvxKV23JjBoMNTJb1axxnFW+4mYpYl/7Ye0NvKxotypBmVSzNQfZOB4n9mUIlXd3+Y9MlgFAJiELoKZV9g6uu1Ili2q5ERnrbcTLDQOpgAHW/SvMXpYnNCsdPTPEEblWXZXBl1xLa7PoZf8kzFPB/ZZRw26QNzAJPgw6NtfW+w72JiHnV1zyQiw7OtSpuVSN9LIA9PcLE7ETui/6653aqNWURX3KK/TrAhOhuX2CxjKKhWi9LWCIxMADknxuYY4qw9zfcx/zMQlj781gOMCrzr1F8D6GcNOjygr6nsyhzXjKryjBH6ZPeh4dJWP3MfH3pj1y6+dJg5Eb34mLY717bpl28KjMaheCsR1uOr2mMF8g+y7DU91j02psxcvIA4z08m4y2g0BSZVwNqKPyfe9ZFriYXhvZZ81lv/5TC/n9M1dmqJWBcveU0es7/isGenX20i9pZUlg0wllXpEhhMZxVZPPSzDtd3bnKsausdGUMCCJfQKUJWJYERSYDsA9HA9S067cpUB6tR9mWVBBMdkbQAAmINUJ7T4MYbteUgm9SPA9mUAXgc1N37gwHYEyTqmJt11MYg1Dq/2NKywJ353MLtdb0yWBeIt6svbtB4HXLcoRHZ00wmMweoH2ZZiKTsGYwC7AP9OxOuw3B7Mk7IEHE9t95j6LmZSkr0B0NgTGYuDsSxQqwfNuVnREbwYydyDKak/U9GvvpZ6CfiXVuCAJ8H+SSYPAl42sUd/A3MezkCvssr5+PM+FugpdO5E5ldncoub/AJQEHpa3O1pjdbMapyTqNhRsUicHQ9jK8t/BX35oJQShUa4D25NA+4REYWJ0b7TLA4J2NgGYwHor1zgDWIew8zEO6B9LL36DRW4mVttFPXPf5AIX+XR7xQFUAfgTKbjVDFzbVAgzrpZkWumrRNga1BklNERc5y32ewnQl1RXb/szD7P78wHmkFn8VSYvgfQz+9QidmX/AH7Ml/nRJwb1QV7nfjo+gjb8ag+0kzD719bTqp/9GaPGYXIVxjxVm14EdzYxLeZRlBRwIgza4+cg8CLYfU5HRJlTpXdx1Pi6vbodM3vMNC1w9+b2eYlh58PZvdjkfkmYn89umUOwJaP8wEpThUq9csA0mWIVUE/mUndSH/HuyfTFWnh4EcZh2c6el3P1SpMofhYi+zKG7VlqqvgSsBUUDwB7sjaXPMRgLT7Mrfqxu71iDwJldq4hGgRKNCvrZ9hmtMTMP53c9L6hyJldzowBJKwEEAjrnxwWq/cxRqlfZmiNyADTGbkP6sy9zylVPkk95jAhTLBtTDpi3+DAOIlFfBJb9sBPJu2huVeRD4j9jKWA92Vy4doqADzsmYgAd+uwIlyP4PXKoBUsJp+2pTvjD4MI/iP/ALMxR8vS64Ursytw6BuuRUFPOFjzEXwPdm74CYv88e3M/lQMVtTXW9CtzAzCsKWcOuf/AMJxLEKB3lK8KlHS3KrrPGVZKWvx+hfwe3VazEt7Gs9D2EscWlwToCVp6lo0CRvoyqw0wBnoUf8A1LPSq/sWGin+wS2qth3QGMCzNMOpCORgAA0B7D4l7zFblYNn35UKuzdxKz8g+hZWLEKmOgrs0xlFotToTqW3BrOQmLSS5sfoQCCDL6PSsmG6cOHXL36JhaYan0R0OPS3lBBi0KdhY2JQ3/CHFoPfhDUqXxR6uUIMekeE9xIUEnwJfaLXmLUEBYfn35tRYBxKLAlyt1s0KnJ8am+KzAQhGY9M5WNXaBvt/wAGJ3UHrmOFqjn1OERQqKvuze6rH/J1MVQtKdM7twg3yRh4EBBAPV7nssla+reFaABQAPA92UALm7QOAw0ujv2Wv/FlKiy4npYNqYTwDDjMFyyN1dgqkmFuHjuJgeXPTIZuRh7jcxyPQr65fciWOeQ4yjvWPZljcK6HczBb5f6tzoEyw83iW8WEXwOhpUxsdW6XNpY7Hcx3BPTLUkRbWrXWjK8xfDQZNP8AfLcv8VzGJBIJ6ZP2QOdmY6rrfXJ5ekeMrtelgYM6r9GLmUGX5QPZIhZiAoJla8RHYKpJjHmWO+0wz2PTLpteUZHpbR4MuiNm1Rnsu7kynGdjB2HuynVmFcoKV3bJgII2PZmWqNLEv03zLAQw2OltQsWOj0WBjBl1cIMxGljmywt5mLQUPNuuV2vbaTGYeunEfQsw6jswi2izcGYo0GlmYW7IItFtp8alda1qAPc99QH3rGPEuAdgzFvVBxPtGbRLHLMZjWIlm2ldiOu1PtexKx8zATJcWeDEOmAZiFlV1L6VW+jdStqzV+MZVm8uxEuy9rpJRQ7kGAaGuttKWj5hBvG5hl/0ZRnLx1bGzKtfLHyWsGiJRhfl4AAND2llUbJAEDq+QSTMe1DaR1c6UmUZn4ugKnwQY2VQp0XmTebTwSY+L+XgAA0PeRsal6elYyTEt2Ck2JkXF7CAflEoqNtnfwIAAOt9LVMWAlGYK04MIliONiNciy67m52uxKKRY+xsDo+wjEeZRk2CzbGAg9HtSsbJllrXvpZXivZ951AAAAOl9fqVkQhh8vcGYVw4cD0turTYJisVJ0PMw6iNuffcnNCfyIzL4ZDMW8WjiejnipMufvMFPLdCNjUvHFpivwuHXKP4Es2AFmMoWhOmSmgWAisfyAFlBU1jiR1yXPKUuTaAVgAA9mTGO1mDop/V5acivecNdhCAG7mYrsfbkKSYKprhogSi/n2MZQw0YcYgaj0upHFYKWHcjcFLSimwMSemRSXPZjPQlANDaPg+x6EaW4f9k+CaJjOH0Uioq9L6PVSHEeJRkVHaxd6G/PR8ap/xPgB/fGwX/ETF0ByMAA8e+3FDsTDgfp5RSagQX9luEtjb5QYCSqsVjQPV60ddMIcCqDAX8vExaE8L7HrR/uUGLTXWSVX6LIreRGwNuYmAqkEvAAPecGktPgaIuLSo1wgAUAD2PTU/3IDPgqP7J8HR/ZErSsaUe160s+9QZ8HR/ZBh0f2RaKkO1QD6RAPmHBpi4lCn7Z49rIrjTDYj4FJgwK4uFQp99lSWLphDh0f2RMSlG5ey7CR4MBx4tgwP28rwq0b6T1V2feoMswSO9LT4fKBleAx+8xEVF0o9jKGGjDgEPHpvpPblFruJ2EaJj22EcxpYqqo0BodCNiPg2BvkhGRX+bJzyj/fBRkP/wATK8H8s0A0PZfQLBPnqbuCIMy5THc2PvUoxiW24gGvoZlI4FwIhKEOsGdVL8g3HikqoZ/MRAi6HXIo5xx6bDXkSnNU9nj5dQTsY9rPK8cOqc4AANDow2CI6bYgqZRcaHIMBBAIMvyBWvY94GffL9yivig37c0EkT1NTB8N/VvWr+YaBPhEldS1jQ9rIpnpJ+p6SwIq+B1IBnEfqa9mh/6cKq3kAw01N5QRaak7KPpEAjRlmJS4gwkgxEiqFGh7XorfyI+Is+CMTFUQAD2MobyJfiufEFFwgxrC0rxBPHssyShIFby253PcECChnXkspa+rYVZj3PZsOmv/AHVr3mqvzxgUDwJwTe+I/wD+FJ//xAAkEQEAAgEEAwEAAgMAAAAAAAABABFgAiAwMRAhQFBBURKQoP/aAAgBAgEBPwD/AE1nC+TMThN7+g/rnxuTm42P4NSiKT0yiolYc8B9puuVeGnw18gRQ36I97zKQi8Gnuau8vCLfDp7j3lwV7YvFpj3loHbFvj09ZaEXkPRhj+AReQjhTwH0hc65dJP5wsjuPp6OZ9GVh6uPKE1OVBc1PN1pyvo5guanKtJF5j0XlfRzBbHrKjnPUY7guPwVKlaZ6w95jw7+j4DTLoi35cNOfqH9sdwRd1NcFSpe28MI8xO4u7SSzcepqTcEqpYRbxIjyhF/gnW4LnXqPraFRbgypU/xlH9y9JHVLeK8KeuKvFQrwR3Hoh3HzU9EXzcuW4uR4r8kYu7qLfmoVLCLeO9HMS9tTrJXmPQxNgRclI8oRbg+bJeTaY98gRcs0x4wmpy0mriCLl/ZwBcqpeKH2DE3BLqXeZX4rwBGpeLn33/ANQ3/8QAFBEBAAAAAAAAAAAAAAAAAAAAwP/aAAgBAwEBPwBN5//Z"/><br/>
								</div>
							</td>
							<td width="300" align="center" valign="middle">
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,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"/><br/>
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