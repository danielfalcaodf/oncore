function showAnimated(elem, animated, callback) {
  $(elem)
    .removeClass()
    .addClass(animated + " animated")
    .one(
      "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",

      callback
    );
}
