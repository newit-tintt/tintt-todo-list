import React, { Component } from 'react';
import '../assets/css/TodoList.css';
import todoListApi from '../api/todoListApi';

class TodoList extends Component {
  constructor(props) {
    super(props);
    this.state = {
      value: '',
      todoList: [],
      isEdit: false,
      currentIndex: -1,
      textUpdate: '',
    };
    this.handleChange = this.handleChange.bind(this);
  }

  /*  Function  */
  handleChange(event) {
    this.setState({ value: event.target.value });
  }

  handleAdd = async () => {
    if (this.state.value !== '') {
      try {
        let idNew = 0;
        let isSuccessCreateId = false;
        while (isSuccessCreateId === false) {
          let idRandom = Math.floor(Math.random() * 100);
          const idExist = this.state.todoList.find((el) => el.id === idRandom);
          if (!idExist) {
            idNew = idRandom;
            break;
          }
        }
        if (idNew !== 0) {
          await todoListApi.insert(JSON.stringify({ id: idNew, text: this.state.value }));
          const response = await todoListApi.getAll({});
          this.setState({ todoList: response });
        }
      } catch (error) {
        console.log('---error---', error);
      }
    }
  };

  handleEdit = (index) => {
    this.setState({
      isEdit: !this.state.isEdit,
      currentIndex: index,
    });
  };

  handleSave = async (index, todo) => {
    let oldText = document.getElementById('updateText').value.defaultValue;
    let text = document.getElementById('updateText').value;
    this.setState({
      isEdit: !this.state.isEdit,
    });

    if (this.state.isEdit === true && this.state.currentIndex === index) {
      if (text !== '') {
        try {
          const params = { id: todo.id, text: text };
          await todoListApi.update(params);
          const response = await todoListApi.getAll({});
          this.setState({ todoList: response });
        } catch (error) {
          console.log('---error---', error);
        }
      }
    }
    return oldText;
  };

  handleDelete = async (id) => {
    try {
      await todoListApi.delete(id);
      const response = await todoListApi.getAll({});
      this.setState({ todoList: response });
    } catch (error) {
      console.log('---error---', error);
    }
  };

  /* Others */
  ToDoItemList = (props) => {
    return (
      <div>
        {props.todoList.map((todo, index) => (
          <div className="TodoItemList">
            {props.isEdit && this.state.currentIndex === index ? (
              <input type="input" className="updateText" defaultValue={todo.text} id="updateText" />
            ) : (
              <div className="content" key={index}>
                {todo.text}
              </div>
            )}
            {props.isEdit && this.state.currentIndex === index ? (
              <button onClick={() => this.handleSave(index, todo)} className="btnSave">
                Save
              </button>
            ) : (
              <button onClick={() => this.handleEdit(index)} className="btnEdit">
                {' '}
                Edit{' '}
              </button>
            )}
            <button className="btnDelete" onClick={() => this.handleDelete(todo.id)}>
              Delete
            </button>
          </div>
        ))}
      </div>
    );
  };

  async componentDidMount() {
    try {
      const response = await todoListApi.getAll({ params: {} });
      this.setState({ todoList: response });
    } catch (error) {
      console.log('---error---', error);
    }
  }

  render() {
    let ToDoItemList = this.ToDoItemList;
    let todoList = this.state.todoList;

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
        <button onClick={this.handleAdd} className="btnAdd">
          Add
        </button>
        <ToDoItemList isEdit={this.state.isEdit} todoList={todoList} className="TodoItemList" />
      </div>
    );
  }
}

export default TodoList;
