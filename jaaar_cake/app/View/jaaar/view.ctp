<?php
	if(isset($img_data)){
		echo "<h2>روزنامه " . $newspaper_names . " مورخ" . $img_data[0]['Jaaar']['date'] . "</h2>";
		echo "<h3><b>آدرس اینترنتی : </b>" . $img_data[0]['Jaaar']['url'] . "</h3>";
		echo "<center>" . $this->Html->image('../files/' . $img_data[0]['Jaaar']['image_name']) . "</center>";
	}
?>