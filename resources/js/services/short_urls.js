import API from './API.js';

/**
 *
 * @type {API<ShortUrl>}
 */
const shortUrlsAPI = new API('/api/short_urls');

export default shortUrlsAPI;