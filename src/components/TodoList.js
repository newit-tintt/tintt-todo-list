import React, { Component } from 'react';
import '../assets/css/TodoList.css';

class TodoList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      value: '',
      todoList: [
        { id: 1, text: 'Tin code' },
        { id: 2, text: 'Tin an com' },
      ],
      isEdit: false,
    };
    this.handleChange = this.handleChange.bind(this);
  }

  /*  Function  */
  handleChange(event) {
    this.setState({ value: event.target.value });
  }

  addTodoList = () => {
    if (this.state.value !== '') {
      this.state.todoList.push({ text: this.state.value });
      this.setState({
        todoList: this.state.todoList,
      });
    }
  };

  handleEdit = () => {
    this.setState({
      isEdit: !this.state.isEdit,
    });
  };

  handleSave = (index) => {
    let text = '';
    text = document.getElementsByClassName('updateText')[index].value;
    if (text !== '') {
      this.setState({
        isEdit: !this.state.isEdit,
      });
      let afterUpdate = [...this.state.todoList];
      afterUpdate[index] = { id: index, text: text };
      this.setState({ todoList: afterUpdate });
    }
  };

  removeTodo = (index) => {
    var afterRemove = [...this.state.todoList];
    if (index !== -1) {
      afterRemove.splice(index, 1);
      this.setState({ todoList: afterRemove });
    }
  };

  /* Others */
  ToDoItemList = (props) => {
    return (
      <div>
        {this.state.todoList.map((todo, index) => (
          <div className="TodoItemList">
            {props.isEdit ? (
              <input type="input" className="updateText" defaultValue={todo.text} />
            ) : (
              <div className="content" key={index}>
                {todo.text}
              </div>
            )}
            {props.isEdit ? (
              <button onClick={() => this.handleSave(index)} className="btnSave">
                Save
              </button>
            ) : (
              <button onClick={this.handleEdit} className="btnEdit">
                {' '}
                Edit{' '}
              </button>
            )}
            <button className="btnDelete" onClick={() => this.removeTodo(index)}>
              Delete
            </button>
          </div>
        ))}
      </div>
    );
  };

  render() {
    let ToDoItemList = this.ToDoItemList;
    return (
      <div className="TodoList">
        <h1>TodoList</h1>
        <input
          type="text"
          placeholder="Enter your work"
          className="inputToDoList"
          value={this.state.value}
          onChange={this.handleChange}
        />
        <button onClick={this.addTodoList} className="btnAdd">
          Add
        </button>
        <ToDoItemList isEdit={this.state.isEdit} todo={this.state.todoList} className="TodoItemList" />
      </div>
    );
  }
}

export default TodoList;
