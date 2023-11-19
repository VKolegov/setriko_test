import API from './API.js';

/**
 *
 * @type {API<ShortURL>}
 */
const shortUrlsAPI = new API('/api/short_urls');

export default shortUrlsAPI;