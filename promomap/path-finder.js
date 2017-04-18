;(function(exports) {

	'use strict';

	var _dist = [],
		_visited = [],
		_parents = [],
		_nodes,
		_prevStart = -1;

	// interface

	exports.calcPathFrom = calcPathFrom;
	exports.getPathTo = getPathTo;
	exports.setNodes = setNodes;
		
	/////////////////

	function setNodes (array) {

		_nodes = array;
		_resetState();

	}

	// basics on Dijkstra's algo
	function calcPathFrom (startNode) {
		
		_resetState();
		
		if(startNode != undefined && _nodes) {

			_dist[startNode] = 0;
			_prevStart = startNode;

			for(var i = 0; i < _nodes.length; i++) {

				var minIndex = -1;

				for(var j = 0; j < _nodes.length; j++) {

					if(!_visited[j] && (minIndex == -1 || _dist[j] < _dist[minIndex])) {
						minIndex = j;
					}
				
				}

				if(_dist[minIndex] == Number.MAX_VALUE) {
					break;
				}

				_visited[minIndex] = true;

				for(var j = 0; j < _nodes[minIndex]['connected'].length; j++) {

					var to = _nodes[minIndex]['connected'][j],
						len = _calcDist(_nodes[minIndex]['cords'], _nodes[to]['cords']);

					if(_dist[minIndex] + len < _dist[to]) {
						_dist[to] = _dist[minIndex] + len;
						_parents[to] = minIndex;
					}	

				}

			}

			return _parents;

		}

		return false;
		
	}

	function getPathTo(finishNode) {

		var path = [];

		if(finishNode != undefined) {
			
			for(var i = finishNode; i != _prevStart; i = _parents[i]) {
				path.push(i);
			}

			path.push(_prevStart);
			path.reverse();
			
			return path;
		}

	}

	function _resetState() {

		_dist = [];
		_visited = [];
		_parents = [];

		for(var i = 0; i < _nodes.length; i++) {
			_dist[i] = Number.MAX_VALUE;
		}

	}

	function _min(array) {

		var currMin = Number.MAX_VALUE,
			minIndex = 0;

		for(var i = 0; i < array.length; i++) {
			if(currMin > array[i]) {
				minIndex = i;
				currMin = array[i];
			}
		}

		return minIndex;
	}

	function _calcDist(pt1, pt2) {

		return Math.sqrt( Math.pow(pt1.x - pt2.x, 2) + Math.pow(pt1.y - pt2.y, 2) );

	}


}) (this.pathFinder = {});

// http://e-maxx.ru/algo/export_dijkstra