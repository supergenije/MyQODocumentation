<h4>Order Types</h4>
<p>The following table describes the available order types for each asset class that <?= $cloudPlatform ? "our Zerodha integration" : "the <code>ZerodhaBrokerageModel</code>" ?> supports:</p>

<table class="qc-table table" id='order-types-table'>
   <thead>
      <tr>
        <th style='width: 50%'>Order Type</th>
        <th>India Equity</th>
      </tr>
   </thead>
   <tbody>
      <tr>
        <td><a href='/docs/v2/writing-algorithms/trading-and-orders/order-types/market-orders'>MarketOrder</a></td>
        <td><img src="https://cdn.quantconnect.com/i/tu/check.png" alt="green check" width="15px;"></td>
      </tr>
      <tr>
        <td><a href='/docs/v2/writing-algorithms/trading-and-orders/order-types/limit-orders'>LimitOrder</a></td>
        <td><img src="https://cdn.quantconnect.com/i/tu/check.png" alt="green check" width="15px;"></td>
      </tr>
      <tr>
        <td><a href='/docs/v2/writing-algorithms/trading-and-orders/order-types/stop-market-orders'>StopMarketOrder</a></td>
        <td><img src="https://cdn.quantconnect.com/i/tu/check.png" alt="green check" width="15px;"></td>
      </tr>
      <tr>
        <td><a href='/docs/v2/writing-algorithms/trading-and-orders/order-types/stop-limit-orders'>StopLimitOrder</a></td>
        <td><img src="https://cdn.quantconnect.com/i/tu/check.png" alt="green check" width="15px;"></td>
      </tr>
   </tbody>
</table>
<style>
#order-types-table td:not(:first-child), 
#order-types-table th:not(:first-child) {
    text-align: center;
}
</style>

<h4>Order Properties</h4>

<p><?= $writingAlgorithms ? "The <code>ZerodhaBrokerageModel</code> supports custom order properties." : "We model custom order properties from the Zerodha API." ?> The following table describes the members of the <code>IndiaOrderProperties</code> object that you can set to customize order execution:</p>

<table class="table qc-table">
    <thead>
        <tr>
            <th style="width: 25%">Property</th>
            <th style="width: 75%">Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Exchange</code></td>
            <td>Select the exchange for sending the order to. The following instructions are supported:
                <ul>
                    <li><code>NSE</code></li>
                    <li><code>BSE</code></li>
                </ul>
            </td>
        </tr>
        <tr>
            <td><code>ProductType</code></td>
            <td>
                A <code>ProductType</code> instruction to apply to the order. The <code>IndiaProductType</code> enumeration has the following members:
                <div data-tree='QuantConnect.Orders.IndiaOrderProperties.IndiaProductType'></div>
            </td>
        </tr>
        <tr>
            <td><code class="csharp">TimeInForce</code><code class="python">time_in_force</code></td>
            <td>A <a href='/docs/v2/writing-algorithms/trading-and-orders/order-properties#03-Time-In-Force'>TimeInForce</a> instruction to apply to the order. The following instructions are supported:
                <ul>
                    <li><code class="csharp">Day</code><code class="python">DAY</code></li>
                    <li><code class="csharp">GoodTilCanceled</code><code class="python">GOOD_TIL_CANCELED</code></li>
                    <li><code class="csharp">GoodTilDate</code><code class="python">GOOD_TIL_DATE</code></li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>

<?php if ($writingAlgorithms) { ?>
<div class="section-example-container">
    <pre class="csharp">public override void Initialize()
{
    // Set default order properties
    DefaultOrderProperties = new IndiaOrderProperties(Exchange.NSE, IndiaOrderProperties.IndiaProductType.NRML)
    {
        TimeInForce = TimeInForce.GoodTilCanceled,
    };
}

public override void OnData(Slice slice)
{
    // Use default order order properties
    LimitOrder(_symbol, quantity, limitPrice);
    
    // Override the default order properties
    LimitOrder(_symbol, quantity, limitPrice, 
               orderProperties: new IndiaOrderProperties(Exchange.BSE, IndiaOrderProperties.IndiaProductType.MIS)
               {
                   TimeInForce = TimeInForce.Day,
               };
    LimitOrder(_symbol, quantity, limitPrice, 
               orderProperties: new IndiaOrderProperties(Exchange.BSE, IndiaOrderProperties.IndiaProductType.CNC)
               {
                   TimeInForce = TimeInForce.GoodTilDate,
               };
}</pre>
    <pre class="python">def initialize(self) -&gt; None:
    # Set the default order properties
    self.default_order_properties = IndiaOrderProperties(Exchange.NSE, IndiaOrderProperties.india_product_type.NRML)
    self.default_order_properties.time_in_force = TimeInForce.GOOD_TIL_CANCELED

def on_data(self, slice: Slice) -&gt; None:
    # Use default order order properties
    self.limit_order(self._symbol, quantity, limit_price)
    
    # Override the default order properties
    order_properties = IndiaOrderProperties(Exchange.BSE, IndiaOrderProperties.india_product_type.MIS)
    order_properties.time_in_force = TimeInForce.DAY
    self.limit_order(self._symbol, quantity, limit_price, order_properties=order_properties)

    order_properties = IndiaOrderProperties(Exchange.BSE, IndiaOrderProperties.india_product_type.CNC)
    order_properties.time_in_force = TimeInForce.GOOD_TIL_DATE
    self.limit_order(self._symbol, quantity, limit_price, order_properties=order_properties)</pre>
</div>
<?php } ?>


<h4>Updates</h4>
<p><?= $writingAlgorithms ? "The <code>ZerodhaBrokerageModel</code> supports" : "We model the Samco Zerodha by supporting" ?> <a href='/docs/v2/writing-algorithms/trading-and-orders/order-management/order-tickets#04-Update-Orders'>order updates</a>.</p>

<?php include(DOCS_RESOURCES."/brokerages/handling-splits.html"); ?>

