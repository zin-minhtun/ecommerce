/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/check-delete.js":
/*!**************************************!*\
  !*** ./resources/js/check-delete.js ***!
  \**************************************/
/***/ (() => {

eval("$('.delete-all-btn').on('click', function deleteConfirm(event) {\n  var res = confirm('Are you sure you want to delete all your records?');\n\n  if (!res) {\n    event.preventDefault();\n  }\n});\n$('.single-delete-btn').on('click', function singleDeleteConfirm(event) {\n  var res = confirm('Are you sure you want to delete?');\n\n  if (!res) {\n    event.preventDefault();\n  } else {\n    multipleDelete();\n  }\n});\n\nfunction multipleDelete() {\n  var role_id = [];\n\n  for (var i = 0; i < $('.cb-element:checked').length; i++) {\n    var e = $('.cb-element:checked')[i];\n    role_id.push($(e).val());\n  }\n\n  $('#form-role').val(JSON.stringify(role_id));\n}\n\nfunction deleteAllBtnAction() {\n  if ($('#checkall').is(':checked')) {\n    $('.delete-all-btn').removeClass('d-none'); // show ( btn => Delete All )\n  } else {\n    $('.delete-all-btn').addClass('d-none'); // hide ( btn => Delete All )\n  }\n}\n\nfunction deleteBtnAction(self) {\n  if ($(self).is(':checked')) {\n    $('.single-delete-btn').removeClass('d-none'); // show ( btn => Delete )\n  } else {\n    $('.single-delete-btn').addClass('d-none'); // hide ( btn => Delete )\n  }\n}\n\n$('#checkall').on('change', function checkAll() {\n  $('.single-delete-btn').addClass('d-none'); // hide ( btn => Delete )\n\n  $('.cb-element').prop('checked', $('#checkall').is(':checked')); // check all cb-element\n\n  if ($('.cb-element').length > 0) {\n    deleteAllBtnAction(); // show/hide ( btn => Delete All )\n  }\n});\n$('.cb-element').on('change', function singleCheck(self) {\n  // console.log(event.target)\n  deleteBtnAction(self); // show/hide ( btn => Delete )\n\n  if ($('.cb-element:checked').length == $('.cb-element').length) {\n    $('#checkall').prop('checked', true); // auto check \n\n    $('.delete-all-btn').removeClass('d-none'); // show ( btn => Delete All )\n\n    $('.single-delete-btn').addClass('d-none'); // hide ( btn => Delete )\n  } else {\n    $('#checkall').prop('checked', false); // auto uncheck\n\n    $('.delete-all-btn').addClass('d-none'); // hide ( btn => Delete All )\n\n    $('.single-delete-btn').removeClass('d-none'); // show ( btn => Delete )\n  }\n\n  if ($('.cb-element:checked').length == 0) {\n    $('.single-delete-btn').addClass('d-none'); // hide ( btn => Delete )\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY2hlY2stZGVsZXRlLmpzPzg5ZTEiXSwibmFtZXMiOlsiJCIsIm9uIiwiZGVsZXRlQ29uZmlybSIsImV2ZW50IiwicmVzIiwiY29uZmlybSIsInByZXZlbnREZWZhdWx0Iiwic2luZ2xlRGVsZXRlQ29uZmlybSIsIm11bHRpcGxlRGVsZXRlIiwicm9sZV9pZCIsImkiLCJsZW5ndGgiLCJlIiwicHVzaCIsInZhbCIsIkpTT04iLCJzdHJpbmdpZnkiLCJkZWxldGVBbGxCdG5BY3Rpb24iLCJpcyIsInJlbW92ZUNsYXNzIiwiYWRkQ2xhc3MiLCJkZWxldGVCdG5BY3Rpb24iLCJzZWxmIiwiY2hlY2tBbGwiLCJwcm9wIiwic2luZ2xlQ2hlY2siXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUMsaUJBQUQsQ0FBRCxDQUFxQkMsRUFBckIsQ0FBd0IsT0FBeEIsRUFBaUMsU0FBU0MsYUFBVCxDQUF1QkMsS0FBdkIsRUFBOEI7QUFDM0QsTUFBSUMsR0FBRyxHQUFHQyxPQUFPLENBQUMsbURBQUQsQ0FBakI7O0FBQ0EsTUFBSSxDQUFDRCxHQUFMLEVBQVU7QUFDTkQsSUFBQUEsS0FBSyxDQUFDRyxjQUFOO0FBQ0g7QUFDSixDQUxEO0FBT0FOLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCQyxFQUF4QixDQUEyQixPQUEzQixFQUFvQyxTQUFTTSxtQkFBVCxDQUE2QkosS0FBN0IsRUFBb0M7QUFDcEUsTUFBSUMsR0FBRyxHQUFHQyxPQUFPLENBQUMsa0NBQUQsQ0FBakI7O0FBQ0EsTUFBSSxDQUFDRCxHQUFMLEVBQVU7QUFDTkQsSUFBQUEsS0FBSyxDQUFDRyxjQUFOO0FBQ0gsR0FGRCxNQUVPO0FBQ0hFLElBQUFBLGNBQWM7QUFDakI7QUFDSixDQVBEOztBQVNBLFNBQVNBLGNBQVQsR0FBMEI7QUFDdEIsTUFBSUMsT0FBTyxHQUFHLEVBQWQ7O0FBQ0EsT0FBSyxJQUFJQyxDQUFDLEdBQUcsQ0FBYixFQUFnQkEsQ0FB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QUFDLGlCQUFELENBQUQsQ0FBcUJvQixRQUFyQixDQUE4QixRQUE5QixFQUZHLENBRXFDOztBQUN4Q3BCLElBQUFBLENBQUMsQ0FBQyxvQkFBRCxDQUFELENBQXdCbUIsV0FBeEIsQ0FBb0MsUUFBcEMsRUFIRyxDQUcyQztBQUNqRDs7QUFDRCxNQUFJbkIsQ0FBQyxDQUFDLHFCQUFELENBQUQsQ0FBeUJXLE1BQXpCLElBQW1DLENBQXZDLEVBQTBDO0FBQ3RDWCxJQUFBQSxDQUFDLENBQUMsb0JBQUQsQ0FBRCxDQUF3Qm9CLFFBQXhCLENBQWlDLFFBQWpDLEVBRHNDLENBQ0s7QUFDOUM7QUFDSixDQWZEIiwic291cmNlc0NvbnRlbnQiOlsiJCgnLmRlbGV0ZS1hbGwtYnRuJykub24oJ2NsaWNrJywgZnVuY3Rpb24gZGVsZXRlQ29uZmlybShldmVudCkge1xuICAgIHZhciByZXMgPSBjb25maXJtKCdBcmUgeW91IHN1cmUgeW91IHdhbnQgdG8gZGVsZXRlIGFsbCB5b3VyIHJlY29yZHM/JylcbiAgICBpZiAoIXJlcykge1xuICAgICAgICBldmVudC5wcmV2ZW50RGVmYXVsdCgpXG4gICAgfVxufSk7XG5cbiQoJy5zaW5nbGUtZGVsZXRlLWJ0bicpLm9uKCdjbGljaycsIGZ1bmN0aW9uIHNpbmdsZURlbGV0ZUNvbmZpcm0oZXZlbnQpIHtcbiAgICB2YXIgcmVzID0gY29uZmlybSgnQXJlIHlvdSBzdXJlIHlvdSB3YW50IHRvIGRlbGV0ZT8nKVxuICAgIGlmICghcmVzKSB7XG4gICAgICAgIGV2ZW50LnByZXZlbnREZWZhdWx0KClcbiAgICB9IGVsc2Uge1xuICAgICAgICBtdWx0aXBsZURlbGV0ZSgpXG4gICAgfVxufSk7XG5cbmZ1bmN0aW9uIG11bHRpcGxlRGVsZXRlKCkge1xuICAgIHZhciByb2xlX2lkID0gW11cbiAgICBmb3IgKHZhciBpID0gMDsgaSA8ICQoJy5jYi1lbGVtZW50OmNoZWNrZWQnKS5sZW5ndGg7IGkrKykge1xuICAgICAgICB2YXIgZSA9ICQoJy5jYi1lbGVtZW50OmNoZWNrZWQnKVtpXTtcbiAgICAgICAgcm9sZV9pZC5wdXNoKCQoZSkudmFsKCkpO1xuICAgIH1cbiAgICAkKCcjZm9ybS1yb2xlJykudmFsKEpTT04uc3RyaW5naWZ5KHJvbGVfaWQpKVxufVxuXG5mdW5jdGlvbiBkZWxldGVBbGxCdG5BY3Rpb24oKSB7XG4gICAgaWYgKCQoJyNjaGVja2FsbCcpLmlzKCc6Y2hlY2tlZCcpKSB7XG4gICAgICAgICQoJy5kZWxldGUtYWxsLWJ0bicpLnJlbW92ZUNsYXNzKCdkLW5vbmUnKSAvLyBzaG93ICggYnRuID0+IERlbGV0ZSBBbGwgKVxuICAgIH0gZWxzZSB7XG4gICAgICAgICQoJy5kZWxldGUtYWxsLWJ0bicpLmFkZENsYXNzKCdkLW5vbmUnKSAvLyBoaWRlICggYnRuID0+IERlbGV0ZSBBbGwgKVxuICAgIH1cbn1cblxuZnVuY3Rpb24gZGVsZXRlQnRuQWN0aW9uKHNlbGYpIHtcbiAgICBpZiAoJChzZWxmKS5pcygnOmNoZWNrZWQnKSkge1xuICAgICAgICAkKCcuc2luZ2xlLWRlbGV0ZS1idG4nKS5yZW1vdmVDbGFzcygnZC1ub25lJykgLy8gc2hvdyAoIGJ0biA9PiBEZWxldGUgKVxuICAgIH0gZWxzZSB7XG4gICAgICAgICQoJy5zaW5nbGUtZGVsZXRlLWJ0bicpLmFkZENsYXNzKCdkLW5vbmUnKSAvLyBoaWRlICggYnRuID0+IERlbGV0ZSApXG4gICAgfVxufVxuXG4kKCcjY2hlY2thbGwnKS5vbignY2hhbmdlJywgZnVuY3Rpb24gY2hlY2tBbGwoKSB7XG4gICAgJCgnLnNpbmdsZS1kZWxldGUtYnRuJykuYWRkQ2xhc3MoJ2Qtbm9uZScpIC8vIGhpZGUgKCBidG4gPT4gRGVsZXRlIClcbiAgICAkKCcuY2ItZWxlbWVudCcpLnByb3AoJ2NoZWNrZWQnLCAkKCcjY2hlY2thbGwnKS5pcygnOmNoZWNrZWQnKSk7IC8vIGNoZWNrIGFsbCBjYi1lbGVtZW50XG4gICAgaWYgKCQoJy5jYi1lbGVtZW50JykubGVuZ3RoID4gMCkge1xuICAgICAgICBkZWxldGVBbGxCdG5BY3Rpb24oKSAvLyBzaG93L2hpZGUgKCBidG4gPT4gRGVsZXRlIEFsbCApXG4gICAgfVxufSk7XG5cbiQoJy5jYi1lbGVtZW50Jykub24oJ2NoYW5nZScsIGZ1bmN0aW9uIHNpbmdsZUNoZWNrKHNlbGYpIHtcbiAgICAvLyBjb25zb2xlLmxvZyhldmVudC50YXJnZXQpXG4gICAgZGVsZXRlQnRuQWN0aW9uKHNlbGYpIC8vIHNob3cvaGlkZSAoIGJ0biA9PiBEZWxldGUgKVxuICAgIGlmICgkKCcuY2ItZWxlbWVudDpjaGVja2VkJykubGVuZ3RoID09ICQoJy5jYi1lbGVtZW50JykubGVuZ3RoKSB7XG4gICAgICAgICQoJyNjaGVja2FsbCcpLnByb3AoJ2NoZWNrZWQnLCB0cnVlKSAvLyBhdXRvIGNoZWNrIFxuICAgICAgICAkKCcuZGVsZXRlLWFsbC1idG4nKS5yZW1vdmVDbGFzcygnZC1ub25lJykgLy8gc2hvdyAoIGJ0biA9PiBEZWxldGUgQWxsIClcbiAgICAgICAgJCgnLnNpbmdsZS1kZWxldGUtYnRuJykuYWRkQ2xhc3MoJ2Qtbm9uZScpIC8vIGhpZGUgKCBidG4gPT4gRGVsZXRlIClcbiAgICB9IGVsc2Uge1xuICAgICAgICAkKCcjY2hlY2thbGwnKS5wcm9wKCdjaGVja2VkJywgZmFsc2UpIC8vIGF1dG8gdW5jaGVja1xuICAgICAgICAkKCcuZGVsZXRlLWFsbC1idG4nKS5hZGRDbGFzcygnZC1ub25lJykgLy8gaGlkZSAoIGJ0biA9PiBEZWxldGUgQWxsIClcbiAgICAgICAgJCgnLnNpbmdsZS1kZWxldGUtYnRuJykucmVtb3ZlQ2xhc3MoJ2Qtbm9uZScpIC8vIHNob3cgKCBidG4gPT4gRGVsZXRlIClcbiAgICB9XG4gICAgaWYgKCQoJy5jYi1lbGVtZW50OmNoZWNrZWQnKS5sZW5ndGggPT0gMCkge1xuICAgICAgICAkKCcuc2luZ2xlLWRlbGV0ZS1idG4nKS5hZGRDbGFzcygnZC1ub25lJykgLy8gaGlkZSAoIGJ0biA9PiBEZWxldGUgKVxuICAgIH1cbn0pOyJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvY2hlY2stZGVsZXRlLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/check-delete.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/check-delete.js"]();
/******/ 	
/******/ })()
;