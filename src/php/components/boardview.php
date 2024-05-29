<?php
$XOMap = [0 => "&nbsp", 1 => "X", 2 => "O"];
?>
<div class="w-64 h-64 grid grid-cols-3 gap-2" x-data="{}">
	<?php
	for ($i = 0; $i < 9; ++$i) {
		$val = $board_obj->input_parsed[$i];
		$cursor_class = $val == 0 ? "cursor-pointer" : "cursor-no-drop";
		$hover_class = $val == 0 ? "hover:bg-indigo-400" : "";
		echo "<div class='flex $cursor_class text-xl justify-center items-center bg-indigo-500 text-gray-300 $hover_class transition-colors duration-150'>{$XOMap[$val]}</div>";
	}
	?>
</div>
<button class="bg-gray-300 text-indigo-500 rounded-md px-3 py-2 hover:text-indigo-400 transition-colors duration-150">Submit Move</button>
