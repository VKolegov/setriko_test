export interface ShortUrl {
    id: number;
    slug: string;
    url: string;
    destination_url: string;
    hits: number;
    name: string | null;
    created_at: string;
}