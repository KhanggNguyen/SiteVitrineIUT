<table>
	<tr>
		<td colspan="4">Votre panier</td>
	</tr>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>


	<?php
	if (ModelCactus::creationPanier())
	{	
		$nbArticles=count($_SESSION['panier']['idc']);
		if ($nbArticles <= 0)
		echo "<tr><td>Votre panier est vide </ td></tr>";
		else
		{
			for ($i=0 ;$i < $nbArticles ; $i++)
			{
				echo "<tr>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['libelleProduit'][$i])."</ td>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['qteProduit'][$i])."</td>";
				echo "<td>".htmlspecialchars($_SESSION['panier']['prixProduit'][$i])."</td>";
				echo "<td><a href='index.php?action=supprimerCactus&idc=".rawurlencode($_SESSION['panier']['idc'][$i])."'>Supprimer</a></td>";
				echo "</tr>";
			}

			echo "<tr><td colspan=\"2\"> </td>";
			echo "<td colspan=\"2\">";
			echo "MontantTotal : ".ModelCactus::MontantGlobal();
			echo "</td></tr>";

			echo "<tr><td colspan=\"5\">";
			echo "<form>";
			echo "<input type=\"hidden\" name=\"action\" value=\"terminerCommande\" />";
			echo "<input type=\"hidden\" name=\"controller\" value=\"commande\" />";
			echo "<input type=\"submit\" value=\"Valider\"/>";

			echo "</td></tr>";
		}
	}
	?>
</table>