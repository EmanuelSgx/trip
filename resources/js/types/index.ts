// Tipos para o sistema TripTech
export interface User {
  id: number
  name: string
  email: string
  role: 'admin' | 'user'
  email_verified_at?: string
  created_at: string
  updated_at: string
}

export interface TravelRequest {
  id: number
  user_id: number
  requester_name: string
  destination: string
  departure_date: string
  return_date: string
  status: 'pending' | 'approved' | 'cancelled'
  notes?: string
  cancellation_reason?: string
  approved_at?: string
  cancelled_at?: string
  approved_by?: number
  created_at: string
  updated_at: string
  user?: User
  approver?: User
}

export interface AuthData {
  user: User
  authorization: {
    token: string
    type: string
    expires_in: number
  }
}

export interface ApiResponse<T> {
  success: boolean
  data?: T
  message?: string
  errors?: Record<string, string[]>
}

export interface PaginatedResponse<T> {
  current_page: number
  data: T[]
  first_page_url: string
  from: number
  last_page: number
  last_page_url: string
  links: Array<{
    url: string | null
    label: string
    active: boolean
  }>
  next_page_url: string | null
  path: string
  per_page: number
  prev_page_url: string | null
  to: number
  total: number
}
