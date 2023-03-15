<p>To fill <?=$orderType?> orders, the model first gets the best effort <code>TradeBar</code>. To get the best effort <code>TradeBar</code>, the model checks the resolution of your security subscription. If your subscription provies <code>Tick</code> data, it gets the most recent back of trade ticks and consolidates them to build a <code>TradeBar</code>. If your subscription provies <code>TradeBar</code> data, it gets the most recent <code>TradeBar</code>. If the <code>EndTime</code> of the best effort <code>TradeBar</code> is less than or equal to the time you placed the order, the model waits until the next best effort <code>TradeBar</code> to fill the order.</p>