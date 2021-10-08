import axiosClient from './axiosClient';

class TodoListApi {
  getAll = (params) => {
    const url = '/todolist';
    return axiosClient.get(url, { params });
  };

  insert = (params) => {
    const url = '/todolist';
    return axiosClient.post(url, params);
  };

  delete = (params) => {
    const url = `/todolist/${params}`;
    return axiosClient.delete(url);
  };

  update = (params) => {
    const url = `/todolist/${params.id}`;
    return axiosClient.put(url, params);
  };
}

const todoListApi = new TodoListApi();

export default todoListApi;
