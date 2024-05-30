<?php
$board_arr_json = json_encode($board_obj->input_parsed);
?>
<div class="w-64 h-64 grid grid-cols-3 gap-2" x-data="board(<?php echo "$board_arr_json" ?>)">
	<?php
	for ($i = 0; $i < 9; ++$i) {
		$val = $board_obj->input_parsed[$i];
		echo "<div class='flex text-xl justify-center items-center bg-indigo-500 text-gray-300 transition-colors duration-150' 
			data-index='$i' 
			x-text='XO_MAP[\$store.globals.board[\$el.dataset.index]]'
			@click='\$store.globals.board[\$el.dataset.index] !== 0 ? null : clickHandler(\$el);'
			:class='\$store.globals.board[\$el.dataset.index] === 0 ? \"cursor-pointer hover:bg-indigo-400\" : \"cursor-no-drop\"'
			>
		</div>";
	}
	?>
</div>
<button x-data="{}" @click="$store.globals.submit($store.globals.board);" :disabled="$store.globals.mutatedCellIdx === null" class="bg-gray-300 text-indigo-500 rounded-md px-3 py-2 transition-colors duration-150" :class="$store.globals.mutatedCellIdx !== null ? 'hover:text-indigo-400' : ''">Submit Move</button>
