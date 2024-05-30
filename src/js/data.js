window.addEventListener("alpine:init", () => {
	Alpine.store('globals', {
		board: null,
		mutatedCellIdx: null,
		submit(board) {
			const newUrl = new URL(window.location.href);
			const params = new URLSearchParams();
			params.set("board", board.join(""));
			newUrl.search = params;
			window.location = newUrl;
		}
	})
	Alpine.data('board', (board = [0, 0, 0, 0, 0, 0, 0, 0, 0]) => ({
		init() {
			this.$store.globals.board = board;
		},
		XO_MAP: ["-", "X", "O"],
		clickHandler(cell) {
			const cellIdx = cell.dataset.index;
			const cellVal = this.$store.globals.board[cellIdx];
			if (cellVal === 0) {
				this.$store.globals.board[cellIdx] = 1;
				if (this.$store.globals.mutatedCellIdx !== null) {
					this.$store.globals.board[this.$store.globals.mutatedCellIdx] = 0;
				}
				this.$store.globals.mutatedCellIdx = cellIdx;
			}
		}
	}))
})
