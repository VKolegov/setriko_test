export interface ShortURL {
    id: number;
    slug: string;
    destination_url: string;
    hits: number;
    name: string | null;
    created_at: string;
}