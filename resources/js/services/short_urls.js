import API from './API.js';

/**
 * @extends {API<ShortUrl, ShortUrlCreateData, ShortUrlUpdateData>}
 */
class ShortUrlsAPI extends API {
  /**
   *
   * @param {number} length
   * @returns {Promise<string>}
   */
  async getFreeSlug (length = 3) {
    try {
      const r = await this.axios.get('free_slug', {
        params: {
          length
        }
      });

      return r.data;
    } catch (e) {
      throw e.response ?? e;
    }
  }
}

const shortUrlsAPI = new ShortUrlsAPI('/api/short_urls');
export default shortUrlsAPI;