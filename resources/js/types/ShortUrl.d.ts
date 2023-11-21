export interface ShortUrl {
    id: number;
    slug: string;
    url: string;
    destination_url: string;
    hits: number;
    name: string | null;
    created_at: string;
}

export interface ShortUrlCreateData {
    destination_url: string;
    slug?: string;
    name?: string;
}

export interface ShortUrlUpdateData {
    destination_url?: string;
    name?: string;
}