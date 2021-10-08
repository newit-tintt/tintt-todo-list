'use strict';
module.exports = function(app) {
  let todoListCtrl = require('./controllers/TodoListController');

  // todoList Routes
  app.route('/todolist')
    .get(todoListCtrl.get)
    .post(todoListCtrl.insert);

  app.route('/todolist/:id')
    .get(todoListCtrl.detail)
    .put(todoListCtrl.update)
    .delete(todoListCtrl.delete);
};