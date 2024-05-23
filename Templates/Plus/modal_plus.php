<script type="text/javascript">
	function ShopUIV2() {
		this.allowSlidePackages = true;
		this.allowSlidePaymentMethods = true;
		this.goldPackagesPages = [];
		this.goldPackagesPagesSize = 0;
		this.paymentMethodsPages = [];
		this.paymentMethodsPageSize = 0;
		this.selectedPaymentMethod = false;
		this.rtl = false;
		this.initialize = function () {
			var b = this;
			if ($$(".paymentWizardDirectionRTL").length > 0) {
				this.rtl = true
			}
			this.slidingContentInnerPackage = $$("#packageSlider .slidingContentInner")[0];
			b.slidingContentOuterPackage = $$("#packageSlider .slidingContentOuter")[0];
			b.slidingContentOuterWidthPackage = b.slidingContentOuterPackage.getDimensions();
			b.slidingContentOuterWidthPackage = parseInt(b.slidingContentOuterWidthPackage.x);
			b.slidingContentInnerPackage.set("tween", {
				duration: 500,
				transition: "linear",
				link: "cancel",
				onComplete: function () {
					b.allowSlidePackages = true
				}
			});
			this.slidingContentInnerPaymentMethods = $$("#paymentMethodsSlider .slidingContentInner")[0];
			b.slidingContentOuterPaymentMethods = $$("#paymentMethodsSlider .slidingContentOuter")[0];
			b.slidingContentOuterWidthPaymentMethods = b.slidingContentOuterPaymentMethods.getDimensions();
			b.slidingContentOuterWidthPaymentMethods = parseInt(b.slidingContentOuterWidthPaymentMethods.x);
			b.slidingContentInnerPaymentMethods.set("tween", {
				duration: 500,
				transition: "linear",
				link: "cancel",
				onComplete: function () {
					b.allowSlidePaymentMethods = true
				}
			});
			var a = 0;
			$$("#packageSlider .productsPage").each(function (d) {
				b.goldPackagesPages[a] = d;
				if (b.goldPackagesPagesSize == 0) {
					var c = d.getStyle("width");
					c = parseInt(c.replace("px", ""));
					b.goldPackagesPagesSize = c
				}
				a++
			});
			b.initializePaymentMethods();
			setTimeout(function () {
				b.packageSliderButtonCheck();
				b.paymentMethodsSliderButtonCheck();
				b.bindEvents();
				b.updateResultBox();
				setTimeout(function () {
					$$("#packageSlider .package.hideForLoading").removeClass("hideForLoading")
				}, 500)
			}, 250)
		};
		this.initializePaymentMethods = function () {
			var b = this;
			$$("#paymentMethodsSlider .loading")[0].removeClass("hide");
			var a = parseInt($$(".package.selected input.goldProductId")[0].get("value"));
			$$("#paymentMethodsSlider .slidingContent")[0].empty();
			b.updateResultBox();
			Travian.ajax({
				data: {cmd: "paymentProviders", selectedPackage: a}, onSuccess: function (d) {
					$$("#paymentMethodsSlider .slidingContent")[0].set("html", d.html);
					if (!b.rtl) {
						b.slidingContentInnerPaymentMethods.setStyle("margin-left", 0)
					} else {
						b.slidingContentInnerPaymentMethods.setStyle("margin-right", 0)
					}
					b.paymentMethodsPages = [];
					b.paymentMethodsPageSize = 0;
					var c = 0;
					$$(".methodsPage").each(function (f) {
						b.paymentMethodsPages[c] = f;
						if (b.paymentMethodsPageSize == 0) {
							var e = f.getStyle("width");
							e = parseInt(e.replace("px", ""));
							b.paymentMethodsPageSize = e
						}
						c++
					});
					$$("#paymentMethodsSlider .methodItem").each(function (g) {
						g.addEvent("click", b.methodItemClickEvent);
						if (b.selectedPaymentMethod !== false) {
							if (parseInt(g.getChildren()[0].get("value")) == b.selectedPaymentMethod) {
								$$("#paymentMethodsSlider .methodItem").removeClass("selected");
								g.addClass("selected");
								for (var e = 0; e < b.paymentMethodsPages.length; e++) {
									if (b.paymentMethodsPages[e] == g.getParent()) {
										var f = e * b.paymentMethodsPageSize;
										if (f == 0) {
											f = 1
										}
										b.allowSlidePaymentMethods = false;
										$$("#paymentMethodsSlider .methodsPage").removeClass("visible").addClass("hidden");
										b.paymentMethodsPages[e].removeClass("hidden").addClass("visible");
										if (!b.rtl) {
											b.slidingContentInnerPaymentMethods.tween("margin-left", f * -1)
										} else {
											b.slidingContentInnerPaymentMethods.tween("margin-right", f * -1)
										}
										b.updateResultBox()
									}
								}
							}
						}
					});
					b.paymentMethodsSliderButtonCheck();
					$$("#paymentMethodsSlider .loading")[0].addClass("hide")
				}
			})
		};
		this.packageSliderButtonCheck = function () {
			var a = this;
			if (typeof a.goldPackagesPages[0] != "undefined") {
				if (a.goldPackagesPages[0].hasClass("visible")) {
					if (!$$("#packageSlider .slideArea.area1")[0].hasClass("inactive")) {
						$$("#packageSlider .slideArea.area1")[0].addClass("inactive")
					}
				} else {
					$$("#packageSlider .slideArea.area1")[0].removeClass("inactive")
				}
				if (a.goldPackagesPages[a.goldPackagesPages.length - 1].hasClass("hidden")) {
					if ($$("#packageSlider .slideArea.area2")[0].hasClass("inactive")) {
						$$("#packageSlider .slideArea.area2")[0].removeClass("inactive")
					}
				} else {
					$$("#packageSlider .slideArea.area2")[0].addClass("inactive")
				}
			}
		};
		this.paymentMethodsSliderButtonCheck = function () {
			var a = this;
			if (typeof a.paymentMethodsPages[0] != "undefined") {
				if (a.paymentMethodsPages[0].hasClass("visible")) {
					if (!$$("#paymentMethodsSlider .slideArea.area1")[0].hasClass("inactive")) {
						$$("#paymentMethodsSlider .slideArea.area1")[0].addClass("inactive")
					}
				} else {
					$$("#paymentMethodsSlider .slideArea.area1")[0].removeClass("inactive")
				}
				if (a.paymentMethodsPages[a.paymentMethodsPages.length - 1].hasClass("hidden")) {
					if ($$("#paymentMethodsSlider .slideArea.area2")[0].hasClass("inactive")) {
						$$("#paymentMethodsSlider .slideArea.area2")[0].removeClass("inactive")
					}
				} else {
					$$("#paymentMethodsSlider .slideArea.area2")[0].addClass("inactive")
				}
			}
		};
		this.bindEvents = function () {
			var a = this;
			$$("#packageSlider .slideArea.area1").addEvent("click", function () {
				a.packageSlideLeft()
			});
			$$("#packageSlider .slideArea.area2").addEvent("click", function () {
				a.packageSlideRight()
			});
			$$("#packageSlider .package").addEvent("click", function () {
				if (!this.hasClass("selected")) {
					$$(".package").removeClass("selected");
					this.addClass("selected");
					a.initializePaymentMethods()
				}
			});
			$$("#phonePackages .package").addEvent("click", function () {
				if (!this.hasClass("selected")) {
					$$(".package").removeClass("selected");
					this.addClass("selected");
					a.initializePaymentMethods()
				}
			});
			$$("#paymentMethodsSlider .slideArea.area1").addEvent("click", function () {
				a.paymentMethodsSlideLeft()
			});
			$$("#paymentMethodsSlider .slideArea.area2").addEvent("click", function () {
				a.paymentMethodsSlideRight()
			});
			$$("#paymentMethodsSlider .methodItem").addEvent("click", a.methodItemClickEvent);
			$$("#paymentMethodsSlider").addEvent("click", function () {
				a.updateResultBox();
				a.saveSelectedPaymentMethod()
			});
			$$("#overview .resultBox .activeButton").addEvent("click", function () {
				a.buyNowAction()
			});
			$$(".buyGoldLocation").addEvent("change", function () {
				a.changeLocation()
			});
			$$("#vouchers .package").addEvent("click", function () {
				voucherPopup()
			})
		};
		this.methodItemClickEvent = function () {
			if (!this.hasClass("inactive") && !this.hasClass("defect")) {
				$$("#paymentMethodsSlider .methodItem").removeClass("selected");
				this.addClass("selected")
			}
		};
		this.updateResultBox = function () {
			$$(".resultBox #packageGoldAmount .goldUnits")[0].set("html", $$(".package.selected .goldUnits")[0].get("html"));
			$$(".resultBox #goldBalanceNew")[0].set("html", (parseInt($$(".package.selected .goldUnits")[0].get("html")) + parseInt($$(".accountBalance span")[0].get("html"))));
			$$(".resultBox #priceToPay")[0].set("html", $$(".package.selected .price")[0].get("html"));
			if ($$("#paymentMethodsSlider .methodItem.selected")[0]) {
				$$(".resultBox .inactiveButton").addClass("hide");
				$$(".resultBox .activeButton").removeClass("hide")
			} else {
				$$(".resultBox .activeButton").addClass("hide");
				$$(".resultBox .inactiveButton").removeClass("hide")
			}
		};
		this.saveSelectedPaymentMethod = function () {
			var a = this;
			if ($$("#paymentMethodsSlider .methodItem.selected")[0]) {
				a.selectedPaymentMethod = parseInt($$("#paymentMethodsSlider .methodItem.selected input.providerId")[0].get("value"))
			}
		};
		this.packageSlideLeft = function () {
			var g = this;
			if (g.allowSlidePackages) {
				var f = "";
				var a = "";
				var b = false;
				for (var c = g.goldPackagesPages.length - 1; c >= 0; c--) {
					if (g.goldPackagesPages[c].hasClass("visible")) {
						f = g.goldPackagesPages[c];
						b = true
					}
					if (b && g.goldPackagesPages[c].hasClass("hidden")) {
						a = g.goldPackagesPages[c];
						break
					}
				}
				if (a != "") {
					var e = 0;
					if (!g.rtl) {
						e = g.slidingContentInnerPackage.getStyle("margin-left")
					} else {
						e = g.slidingContentInnerPackage.getStyle("margin-right")
					}
					e = parseInt(e.replace("px", ""));
					var d = (e + g.goldPackagesPagesSize);
					if (d == 0) {
						d = 1
					}
					f.removeClass("visible").addClass("hidden");
					a.removeClass("hidden").addClass("visible");
					g.allowSlidePackages = false;
					if (!g.rtl) {
						g.slidingContentInnerPackage.tween("margin-left", d)
					} else {
						g.slidingContentInnerPackage.tween("margin-right", d)
					}
				}
			}
			g.packageSliderButtonCheck()
		};
		this.packageSlideRight = function () {
			var g = this;
			if (g.allowSlidePackages) {
				var f = "";
				var a = "";
				var b = false;
				for (var c = 0; c < g.goldPackagesPages.length; c++) {
					if (g.goldPackagesPages[c].hasClass("visible")) {
						f = g.goldPackagesPages[c];
						b = true
					}
					if (g.goldPackagesPages[c].hasClass("hidden")) {
						if (b) {
							a = g.goldPackagesPages[c];
							break
						}
					}
				}
				if (a != "") {
					var e = 0;
					if (!g.rtl) {
						e = g.slidingContentInnerPackage.getStyle("margin-left")
					} else {
						e = g.slidingContentInnerPackage.getStyle("margin-right")
					}
					e = parseInt(e.replace("px", "")) * -1;
					var d = (e + g.goldPackagesPagesSize) * -1;
					f.removeClass("visible").addClass("hidden");
					a.removeClass("hidden").addClass("visible");
					g.allowSlidePaymentMethods = false;
					if (!g.rtl) {
						g.slidingContentInnerPackage.tween("margin-left", d)
					} else {
						g.slidingContentInnerPackage.tween("margin-right", d)
					}
				}
			}
			g.packageSliderButtonCheck()
		};
		this.paymentMethodsSlideLeft = function () {
			var g = this;
			if (g.allowSlidePaymentMethods) {
				var f = "";
				var a = "";
				var b = false;
				for (var c = g.paymentMethodsPages.length - 1; c >= 0; c--) {
					if (g.paymentMethodsPages[c].hasClass("visible")) {
						f = g.paymentMethodsPages[c];
						b = true
					}
					if (b && g.paymentMethodsPages[c].hasClass("hidden")) {
						a = g.paymentMethodsPages[c];
						break
					}
				}
				if (a != "") {
					var e = 0;
					if (!g.rtl) {
						e = g.slidingContentInnerPaymentMethods.getStyle("margin-left")
					} else {
						e = g.slidingContentInnerPaymentMethods.getStyle("margin-right")
					}
					e = parseInt(e.replace("px", ""));
					var d = (e + g.paymentMethodsPageSize);
					if (d == 0) {
						d = 1
					}
					f.removeClass("visible").addClass("hidden");
					a.removeClass("hidden").addClass("visible");
					g.allowSlidePaymentMethods = false;
					if (!g.rtl) {
						g.slidingContentInnerPaymentMethods.tween("margin-left", d)
					} else {
						g.slidingContentInnerPaymentMethods.tween("margin-right", d)
					}
				}
			}
			g.paymentMethodsSliderButtonCheck()
		};
		this.paymentMethodsSlideRight = function () {
			var g = this;
			if (g.allowSlidePaymentMethods) {
				var f = "";
				var a = "";
				var b = false;
				for (var c = 0; c < g.paymentMethodsPages.length; c++) {
					if (g.paymentMethodsPages[c].hasClass("visible")) {
						f = g.paymentMethodsPages[c];
						b = true
					}
					if (g.paymentMethodsPages[c].hasClass("hidden")) {
						if (b) {
							a = g.paymentMethodsPages[c];
							break
						}
					}
				}
				if (a != "") {
					var e = 0;
					if (!g.rtl) {
						e = g.slidingContentInnerPaymentMethods.getStyle("margin-left")
					} else {
						e = g.slidingContentInnerPaymentMethods.getStyle("margin-right")
					}
					e = parseInt(e.replace("px", "")) * -1;
					var d = (e + g.paymentMethodsPageSize) * -1;
					f.removeClass("visible").addClass("hidden");
					a.removeClass("hidden").addClass("visible");
					g.allowSlidePaymentMethods = false;
					if (!g.rtl) {
						g.slidingContentInnerPaymentMethods.tween("margin-left", d)
					} else {
						g.slidingContentInnerPaymentMethods.tween("margin-right", d)
					}
				}
			}
			g.paymentMethodsSliderButtonCheck()
		};
		this.buyNowAction = function () {
			if ($$("#overview .resultBox .inactiveButton.hide")[0]) {
				var e = parseInt($$(".package.selected input.goldProductId")[0].get("value"));
				var b = parseInt($$("#paymentMethodsSlider .methodItem.selected input.providerId")[0].get("value"));
				var d = 800;
				var f = 600;
				if ($$("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]) {
					d = $$("#paymentMethodsSlider .methodItem.selected input.popupWidth")[0]
				}
				if ($$("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]) {
					f = $$("#paymentMethodsSlider .methodItem.selected input.popupHeight")[0]
				}
				var a = (screen.width - d) / 2;
				var c = (screen.height - f) / 2;
				window.open("/tgpay.php?product=" + e + "&provider=" + b, "tgpay", "scrollbars=yes,status=yes,resizable=yes,toolbar=yes,width=" + d + ",height=" + f + ",left=" + a + ",top=" + c)
			}
		};
		this.changeLocation = function () {
			var a = $$("select.buyGoldLocation")[0].getSelected()[0].get("value");
			window.fireEvent("startPaymentWizard", {
				data: {
					cmd: "paymentWizard",
					goldProductId: "",
					goldProductLocation: a,
					location: "",
					activeTab: "buyGold",
					formData: {}
				}
			})
		};
		this.selectPackage = function (e) {
			var d = this;
			var f = $$(".package input[value=" + e + "]")[0];
			e = f.getParent();
			var a = e.getParent();
			if (a.id != "phonePackages") {
				if (a.hasClass("hidden")) {
					for (var b = 0; b < d.goldPackagesPages.length; b++) {
						if (d.goldPackagesPages[b] == a) {
							var c = b * d.goldPackagesPagesSize;
							if (c == 0) {
								c = 1
							}
							d.allowSlidePackages = false;
							$$("#packageSlider .productsPage").removeClass("visible").addClass("hidden");
							d.goldPackagesPages[b].removeClass("hidden").addClass("visible");
							if (!d.rtl) {
								d.slidingContentInnerPackage.tween("margin-left", c * -1)
							} else {
								d.slidingContentInnerPackage.tween("margin-right", c * -1)
							}
						}
					}
				}
			}
			$$(".package").removeClass("selected");
			e.addClass("selected")
		}
	}
</script>