import axios from 'axios';

/**
 * @template T
 */
export default class API {

  /**
   *
   * @type {axios.AxiosInstance}
   */
  axios;

  /**
   *
   * @param {string} apiEndpoint
   */
  constructor (apiEndpoint) {

    this.axios = axios.create({
      baseURL: apiEndpoint,
    });
  }

  /**
   *
   * @param {Object|null} params
   * @returns {Promise<PaginatedResponse<T>>}
   */
  async fetch (params = null) {

    try {
      const reqParams = this.prepareFetchParams(params);

      const r = await this.axios.get('/', {
          params: reqParams,
        },
      );

      return r.data;
    } catch (e) {
      throw e.response ?? e;
    }
  }

  /**
   *
   * @param {number} id
   * @param {?object} params
   * @return {Promise<Object>}
   */
  async fetchOne (id, params = null) {

    try {
      const r = await this.axios.get(id.toString(), {
        params: params,
      });

      return r.data;

    } catch (e) {
      throw e.response ?? e;
    }
  }

  /**
   *
   * @param {object|FormData} data
   * @return {Promise<any>}
   */
  async create (data) {

    const headers = {};
    if (data instanceof FormData) {
      headers['Content-Type'] = 'multipart/form-data';
    }

    try {
      const r = await this.axios.post('/', data, {
        headers,
      });

      return r.data;
    } catch (e) {
      throw e.response ?? e;
    }
  }

  /**
   *
   * @param {number} id
   * @param {object|FormData} data
   * @return {Promise<any>}
   */
  async update (id, data) {

    try {
      const r = await this.axios.patch(id.toString(), data);

      return r.data;
    } catch (e) {
      throw e.response ?? e;
    }
  }

  /**
   *
   * @param {string|number} id
   * @return {Promise<any>}
   */
  async delete (id) {

    try {
      const r = await this.axios.delete(id.toString());

      return r.data;
    } catch (e) {
      throw e.response ?? e;
    }
  }

  /**
   * @param {Object} params
   * @returns {Object}
   */
  prepareFetchParams (params) {

    if (!params || typeof params !== 'object') {
      return {};
    }

    const reqParams = {};

    for (const [key, value] of Object.entries(params)) {
      if (typeof value === 'boolean') {
        reqParams[key] = value ? 1 : 0;
      } else {
        reqParams[key] = value;
      }
    }

    return reqParams;
  }

}
