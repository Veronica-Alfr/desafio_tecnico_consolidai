import { AxiosError } from 'axios';

export interface IApiErrorResponse {
    message: string;
    statusCode?: number;
    error?: string;
}

export type AxiosApiError = AxiosError<IApiErrorResponse>;