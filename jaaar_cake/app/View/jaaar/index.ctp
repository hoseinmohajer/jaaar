<?php
	echo "<h2>مشاهده 10 روزنامه منتخب سال 1392 با انتخاب تاریخ دلخواهتان</h2>";
	echo $this->Form->Create('index',array('url'=>'/jaaars/view/'));
	echo $this->Form->input('newspaper_names', array('label' => 'نام روزنامه', 'options' => $newspaper_names));
	echo $this->Html->mkjalalidt('', 'jaaar', 'تاریخ مورد نظر');
	echo $this->Form->submit('مشاهده روزنامه');
?>