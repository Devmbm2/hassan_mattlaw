<h1>{$storeName}</h1>
<h2>Location: {$location}</h2>
<ul>
{foreach name=productsIteration from=$products key=id item=product}
<li>{$product->name}: {$product->price}</li>
</ul>