<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Подключение внешних стилей
$arComponent = $this->__component;
$templateFolder = $arComponent->GetPath();
$this->addExternalCss($templateFolder . "/template_styles.css");

if ($arResult["ShowReady"]=="Y" || $arResult["ShowDelay"]=="Y" || $arResult["ShowSubscribe"]=="Y" || $arResult["ShowNotAvail"]=="Y")
{
	foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
		$arHeader["name"] = (isset($arHeader["name"]) ? (string)$arHeader["name"] : '');
		if ($arHeader["name"] == '')
		{
			$arResult["GRID"]["HEADERS"][$id]["name"] = GetMessage("SALE_".$arHeader["id"]);
			if($arResult["GRID"]["HEADERS"][$id]["name"] == '')
				$arResult["GRID"]["HEADERS"][$id]["name"] = GetMessage("SALE_".str_replace("_FORMATED", "", $arHeader["id"]));
		}
	endforeach;

	// ==========================================
	// Товары, готовые к покупке (ShowReady)
	// ==========================================
	if ($arResult["ShowReady"]=="Y")
	{
		foreach ($arResult["ITEMS"]["AnDelCanBuy"] as &$v)
		{
			$productName = isset($v["NAME"]) ? $v["NAME"] : '';
			$detailUrl   = isset($v["DETAIL_PAGE_URL"]) ? $v["DETAIL_PAGE_URL"] : '';
			$pictureSrc  = '';

			if (!empty($v["PREVIEW_PICTURE_SRC"]))
				$pictureSrc = $v["PREVIEW_PICTURE_SRC"];
			elseif (!empty($v["DETAIL_PICTURE_SRC"]))
				$pictureSrc = $v["DETAIL_PICTURE_SRC"];
			elseif (!empty($v["PICTURE_SRC"]))
				$pictureSrc = $v["PICTURE_SRC"];

			$priceValue = '';
			if (!empty($v["SUM_FORMATED"]))
				$priceValue = $v["SUM_FORMATED"];
			elseif (!empty($v["PRICE_FORMATED"]))
				$priceValue = $v["PRICE_FORMATED"];

			$basketUrl = '' != $arParams["PATH_TO_BASKET"] ? $arParams["PATH_TO_BASKET"] : '#';
			$orderUrl  = '' != $arParams["PATH_TO_ORDER"] ? $arParams["PATH_TO_ORDER"] : '#';
			?>
			<table width="100%" cellpadding="0" cellspacing="0" class="sbbm-card">
				<tr>
					<td class="sbbm-card-cell">
						<table width="100%" cellpadding="0" cellspacing="0" class="sbbm-card-inner">
							<tr>
								<td width="120" class="sbbm-img">
									<?if ($pictureSrc !== ''):?>
										<img src="<?=htmlspecialcharsbx($pictureSrc)?>" alt="<?=htmlspecialcharsbx($productName)?>">
									<?else:?>
										<img src="https://via.placeholder.com/120x150/f0f0f0/999999?text=<?=rawurlencode($productName)?>" alt="<?=htmlspecialcharsbx($productName)?>">
									<?endif;?>
								</td>
								<td class="sbbm-info">
									<h3>
										<?if ($detailUrl !== ''):?>
											<a href="<?=htmlspecialcharsbx($detailUrl)?>"><?=htmlspecialcharsbx($productName)?></a>
										<?else:?>
											<?=htmlspecialcharsbx($productName)?>
										<?endif;?>
									</h3>
									<p class="sbbm-price">Сумма: <br><?=$priceValue?></p>
									<table class="sbbm-btns" cellpadding="0" cellspacing="0">
										<tr>
											<td>
												<a href="<?=htmlspecialcharsbx($basketUrl)?>" class="sbbm-btn">Изменить количество</a>
											</td>
											<td>
												<a href="<?=htmlspecialcharsbx($orderUrl)?>" class="sbbm-btn">Оформить заказ</a>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?
		}
		if (isset($v))
			unset($v);
	}

	// ==========================================
	// Товары, отложенные (ShowDelay)
	// ==========================================
	if ($arResult["ShowDelay"]=="Y")
	{
		?>
		<table class="sale_basket_small">
			<tr><td align="center"><?= GetMessage("TSBS_DELAY") ?></td></tr>
			<tr><td>
				<ul>
				<?foreach ($arResult["ITEMS"]["DelDelCanBuy"] as &$v):?>
					<li>
						<?foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):?>
							<?if(isset($v[$arHeader['id']]) && !empty($v[$arHeader['id']])):?>
								<?if(in_array($arHeader['id'], array("NAME"))):?>
									<?if ('' != $v["DETAIL_PAGE_URL"]):?>
										<a href="<?=$v["DETAIL_PAGE_URL"]?>"><b><?=$v[$arHeader['id']]?></b></a><br />
									<?else:?>
										<b><?=$v[$arHeader['id']]?></b><br />
									<?endif;?>
								<?elseif(in_array($arHeader['id'], array("PRICE_FORMATED"))):?>
									<?=$arHeader['name']?>:&nbsp;<b><?=$v[$arHeader['id']]?></b><br />
								<?elseif(in_array($arHeader['id'], ["DETAIL_PICTURE", "PREVIEW_PICTURE"]) && !empty($v[$arHeader['id']."_SRC"])):?>
									<?=$arHeader['name']?>:&nbsp;<br/><img src="<?=$v[$arHeader['id']."_SRC"]?>"><br/>
								<?else:?>
									<?=$arHeader['name']?>:&nbsp;<?=$v[$arHeader['id']]?><br />
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
					</li>
				<?endforeach;?>
				<?if (isset($v)) unset($v);?>
				</ul>
			</td></tr>
		</table>
		<?
	}

	// ==========================================
	// Товары, ожидающие подписки (ShowSubscribe)
	// ==========================================
	if ($arResult["ShowSubscribe"]=="Y")
	{
		?>
		<table class="sale_basket_small">
			<tr><td align="center"><?= GetMessage("TSBS_SUBSCRIBE") ?></td></tr>
			<tr><td>
				<ul>
				<?foreach ($arResult["ITEMS"]["ProdSubscribe"] as &$v):?>
					<li>
						<?foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):?>
							<?if(isset($v[$arHeader['id']]) && !empty($v[$arHeader['id']])):?>
								<?if(in_array($arHeader['id'], array("NAME"))):?>
									<?if ('' != $v["DETAIL_PAGE_URL"]):?>
										<a href="<?=$v["DETAIL_PAGE_URL"]?>"><b><?=$v[$arHeader['id']]?></b></a><br />
									<?else:?>
										<b><?=$v[$arHeader['id']]?></b><br />
									<?endif;?>
								<?elseif(in_array($arHeader['id'], array("PRICE_FORMATED"))):?>
									<?=$arHeader['name']?>:&nbsp;<b><?=$v[$arHeader['id']]?></b><br />
								<?elseif(in_array($arHeader['id'], ["DETAIL_PICTURE", "PREVIEW_PICTURE"]) && !empty($v[$arHeader['id']."_SRC"])):?>
									<?=$arHeader['name']?>:&nbsp;<br/><img src="<?=$v[$arHeader['id']."_SRC"]?>"><br/>
								<?else:?>
									<?=$arHeader['name']?>:&nbsp;<?=$v[$arHeader['id']]?><br />
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
					</li>
				<?endforeach;?>
				<?if (isset($v)) unset($v);?>
				</ul>
			</td></tr>
		</table>
		<?
	}

	// ==========================================
	// Товары, недоступные для покупки (ShowNotAvail)
	// ==========================================
	if ($arResult["ShowNotAvail"]=="Y")
	{
		?>
		<table class="sale_basket_small">
			<tr><td align="center"><?= GetMessage("TSBS_UNAVAIL") ?></td></tr>
			<tr><td>
				<ul>
				<?foreach ($arResult["ITEMS"]["nAnCanBuy"] as &$v):?>
					<li>
						<?foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):?>
							<?if(isset($v[$arHeader['id']]) && !empty($v[$arHeader['id']])):?>
								<?if(in_array($arHeader['id'], array("NAME"))):?>
									<?if ('' != $v["DETAIL_PAGE_URL"]):?>
										<a href="<?=$v["DETAIL_PAGE_URL"]?>"><b><?=$v[$arHeader['id']]?></b></a><br />
									<?else:?>
										<b><?=$v[$arHeader['id']]?></b><br />
									<?endif;?>
								<?elseif(in_array($arHeader['id'], array("PRICE_FORMATED"))):?>
									<?=$arHeader['name']?>:&nbsp;<b><?=$v[$arHeader['id']]?></b><br />
								<?elseif(in_array($arHeader['id'], ["DETAIL_PICTURE", "PREVIEW_PICTURE"]) && !empty($v[$arHeader['id']."_SRC"])):?>
									<?=$arHeader['name']?>:&nbsp;<br/><img src="<?=$v[$arHeader['id']."_SRC"]?>"><br/>
								<?else:?>
									<?=$arHeader['name']?>:&nbsp;<?=$v[$arHeader['id']]?><br />
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
					</li>
				<?endforeach;?>
				<?if (isset($v)) unset($v);?>
				</ul>
			</td></tr>
		</table>
		<?
	}
}
?>
